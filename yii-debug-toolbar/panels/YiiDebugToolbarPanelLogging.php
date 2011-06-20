<?php
/**
 * YiiDebugToolbarPanelLogging class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @link http://www.vidomo.com/
 * @copyright Copyright &copy; 2000-2011 Vidomo
 * @license http://www.vidomo.com/terms-of-use
 */


/**
 * YiiDebugToolbarPanelLogging represents an ...
 *
 * Description of YiiDebugToolbarPanelLogging
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugToolbarPanelLogging extends YiiDebugToolbarPanel implements DebugToolbarPanelInterface
{
    private $_countMessages,
            $_logs;

    public function getMenuTitle()
    {
        return 'Logging';
    }

    public function getMenuSubTitle()
    {
        return vsprintf('%s MESSAGES', $this->countMessages);
    }

    public function getTitle()
    {
        return 'Log Messages';
    }

    public function getSubTitle()
    {
        
    }

    public function getLogs()
    {
        if (null === $this->_logs)
        {
            $this->_logs = $this->filterLogs();
        }
        return $this->_logs;
    }

    public function getCountMessages()
    {
        if (null === $this->_countMessages)
        {
            $this->_countMessages = count($this->logs);
        }
        return $this->_countMessages;
    }
    
    public function run()
    {
        $this->render('logging', array(
            'logs'=>$this->logs
        ));
    }

    protected function filterLogs()
    {
        $logs = array();
        foreach ($this->owner->getLogs() as $entry)
        {
            if (CLogger::LEVEL_PROFILE !== $entry[1] &&  false === strpos($entry[2], 'system.db.CDbCommand'))
            {
                $logs[] = $entry;
            }
        }
        return $logs;
    }
}
