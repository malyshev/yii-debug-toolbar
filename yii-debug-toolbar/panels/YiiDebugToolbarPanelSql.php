<?php
/**
 * YiiDebugToolbarPanelSql class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */


/**
 * YiiDebugToolbarPanelSql represents an ...
 *
 * Description of YiiDebugToolbarPanelSql
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @author Igor Golovanov <igor.golovanov@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */
class YiiDebugToolbarPanelSql extends YiiDebugToolbarPanel
{
    private $_groupByToken = true;

    private $_dbConnections;
    private $_dbConnectionsCount;

    public function getDbConnectionsCount()
    {
        if (null === $this->_dbConnectionsCount)
        {
            $this->_dbConnectionsCount = count($this->getDbConnections());
        }
        return $this->_dbConnectionsCount;
    }

    public function getDbConnections()
    {
        if (null === $this->_dbConnections)
        {
            $this->_dbConnections = array();
            foreach (Yii::app()->components as $id=>$component)
            {
                if (false !== is_object($component)
                        && false !== ($component instanceof CDbConnection))
                {
                    $this->_dbConnections[$id] = $component;
                }
            }
        }
        return $this->_dbConnections;
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuTitle()
    {
        return 'SQL';
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuSubTitle()
    {
        return vsprintf('%s QUERIES IN %0.4fS', Yii::app()->db->getStats());
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return vsprintf('SQL Queries from %s connections', array(
            $this->getDbConnectionsCount()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return '(' . vsprintf('%s QUERIES IN %0.6fS', Yii::app()->db->getStats()) . ')';
    }

    public function init()
    {
        try
        {
            Yii::app()->db->enableProfiling = true;
            Yii::app()->db->enableParamLogging = true;
        }
        catch (Exception $e)
        {
            // @todo 
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $logs = $this->filterLogs();
        
        $this->render('sql', array(
            'connections'       => $this->getDbConnections(),
            'connectionsCount'  => $this->getDbConnectionsCount(),
            'summary'           => $this->processSummary($logs),
            'callstack'         => $this->processCallstack($logs)
        ));
    }

    /**
     * Processing callstack.
     * 
     * @param array $logs Logs.
     * @return array
     */
    protected function processCallstack(array $logs)
    {
        if (empty($logs))
        {
            return $logs;
        }

        $stack   = array();
        $results = array();
        $n       = 0;

        foreach($logs as $log)
        {
            if(CLogger::LEVEL_PROFILE !== $log[1])
                continue;
            
            $message = $log[0];
            
            if(!strncasecmp($message,'begin:',6))
            {
                $log[0]  = substr($message,6);
                $log[4]  = $n;
                $stack[] = $log;
                $n++;
            }
            else if(!strncasecmp($message, 'end:', 4))
            {
                $token = substr($message,4);
                if(null !== ($last = array_pop($stack)) && $last[0] === $token)
                {
                    $delta = $log[3] - $last[3];
                    $results[$last[4]] = array($token, $delta, count($stack));
                }
                else
                    throw new CException(strtr('Mismatching code block "{token}". Make sure the calls to Yii::beginProfile() and Yii::endProfile() be properly nested.',
                        array('{token}' => $token)));
            }
        }
        // remaining entries should be closed here
        $now = microtime(true);
        while(null !== ($last = array_pop($stack)))
            $results[$last[4]] = array($last[0], $now - $last[3], count($stack));

        ksort($results);

        return array_map(array($this, 'formatLogEntry'), $results);
    }

    /**
     * Processing summary.
     * 
     * @param array $logs Logs.
     * @return array
     */
    protected function processSummary(array $logs)
    {
        if (empty($logs))
        {
            return $logs;
        }
        $stack = array();
        foreach($logs as $log)
        {
            $message = $log[0];
            if(!strncasecmp($message, 'begin:', 6))
            {
                $log[0]  =substr($message, 6);
                $stack[] =$log;
            }
            else if(!strncasecmp($message,'end:',4))
            {
                $token = substr($message,4);
                if(null !== ($last = array_pop($stack)) && $last[0] === $token)
                {
                    $delta = $log[3] - $last[3];
                    if(isset($results[$token]))
                        $results[$token] = $this->aggregateResult($results[$token], $delta);
                    else
                        $results[$token] = array($token, 1, $delta, $delta, $delta);
                }
                else
                    throw new CException(strtr('Mismatching code block "{token}". Make sure the calls to Yii::beginProfile() and Yii::endProfile() be properly nested.',
                        array('{token}' => $token)));
            }
        }

        $now = microtime(true);
        while(null !== ($last = array_pop($stack)))
        {
            $delta = $now - $last[3];
            $token = $last[0];

            if(isset($results[$token]))
                $results[$token] = $this->aggregateResult($results[$token], $delta);
            else
                $results[$token] = array($token, 1, $delta, $delta, $delta);
        }

        $entries = array_values($results);
        $func    = create_function('$a,$b','return $a[4]<$b[4]?1:0;');

        usort($entries, $func);

        return array_map(array($this, 'formatLogEntry'), $entries);
    }

    public function formatLogEntry($entry)
    {
        $queryString = $entry[0];
        $queryString = substr($queryString, strpos($queryString, '('));
        $queryString = trim($queryString, '()');

        if (false !== strpos($queryString, '. Bound with '))
        {
            list($query, $params) = explode('. Bound with ', $queryString);

            $params = explode(',', $params);
            $binds  = array();

            foreach($params as $param)
            {
                list($key,$value) = explode('=', $param);
                $binds[trim($key)] = trim($value);
            }

            $entry[0] = strtr($query, $binds);
        }
        else
        {
            $entry[0] = $queryString;
        }
        return $entry;
    }


    /**
     * Aggregates the report result.
     *
     * @param array $result log result for this code block
     * @param float $delta time spent for this code block
     * @return array
     */
    protected function aggregateResult($result,$delta)
    {
        list($token, $calls, $min, $max, $total) = $result;

        switch (true) {
            case ($delta < $min):
                $min = $delta;
                break;
            case ($delta > $max):
                $max = $delta;
                break;
            default:
                // nothing 
                break;
        }

        $calls++;
        $total += $delta;
        
        return array($token, $calls, $min, $max, $total);
    }

    /**
     * Get filter logs.
     * 
     * @return array
     */
    protected function filterLogs()
    {
        $logs = array();
        foreach ($this->owner->getLogs() as $entry)
        {
            if (CLogger::LEVEL_PROFILE === $entry[1] && 0 === strpos($entry[2], 'system.db.CDbCommand'))
            {
                $logs[] = $entry;
            }
        }
        return $logs;
    }

}
