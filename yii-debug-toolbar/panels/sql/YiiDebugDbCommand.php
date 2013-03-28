<?php

/**
 * YiiDebugDbCommand class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugDbCommand represents an ...
 *
 * Description of YiiDebugDbCommand
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class YiiDebugDbCommand extends YiiDebugComponentProxy
{

    public function execute($params = array())
    {
        $this->trace('execute', $params);
        return $this->instance->execute($params);
    }

    public function query($params = array())
    {
        $params = array_merge($this->params, $params);
        $this->trace('query', $params);
        return $this->instance->query($params);
    }

    public function queryAll($fetchAssociative = true, $params = array())
    {
        $params = array_merge($this->params, $params);
        $this->trace('queryAll', $params);
        return $this->instance->queryAll($fetchAssociative, $params);
    }

    public function queryRow($fetchAssociative = true, $params = array())
    {
        $params = array_merge($this->params, $params);
        $this->trace('queryRow', $params);
        return $this->instance->queryRow($fetchAssociative, $params);
    }

    public function queryScalar($params = array())
    {
        $params = array_merge($this->params, $params);
        $this->trace('queryScalar', $params);
        return $this->instance->queryScalar($params);
    }

    public function queryColumn($params = array())
    {
        $params = array_merge($this->params, $params);
        $this->trace('queryColumn', $params);
        return $this->instance->queryColumn($params);
    }

    private function getParamLog()
    {
        return YiiDebug::getClassProperty($this->instance, '_paramLog')->getValue($this->instance);
    }

    private function trace($method, $params)
    {
        
    }

}