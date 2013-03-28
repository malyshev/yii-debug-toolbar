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
    public function update($table, $columns, $conditions='', $params=array())
    {
        $result = $this->instance->update($table, $columns, $conditions, $params);
        return $result;
    }
    
    public function delete($table, $conditions='', $params=array())
    {
        $result = $this->instance->delete($table, $conditions, $params);
        return $result;
    }
    
    public function execute($params = array())
    {
        $result = $this->instance->execute($params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }

    public function query($params = array())
    {
        $result = $this->instance->query($params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }

    public function queryAll($fetchAssociative = true, $params = array())
    {
        $result = $this->instance->queryAll($fetchAssociative, $params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }

    public function queryRow($fetchAssociative = true, $params = array())
    {
        $result = $this->instance->queryRow($fetchAssociative, $params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }

    public function queryScalar($params = array())
    {
        $result = $this->instance->queryScalar($params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }

    public function queryColumn($params = array())
    {
        $result = $this->instance->queryColumn($params);
        $this->owner->logConnection($this->getConnection());
        return $result;
    }
}