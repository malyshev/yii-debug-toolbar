<?php
/**
 * YiiDebugComponentProxy class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugComponentProxy represents an ...
 *
 * Description of YiiDebugComponentProxy
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugComponentProxy extends CComponent
{

    private $_instance;
    
    private $_owner;

    private $_isProxy;
    
    protected $abstract = array();

    public function init()
    {
    }
    
    public function setOwner(YiiDebugToolbarPanel $owner)
    {
        if (null === $this->_owner)
        {
            $this->_owner = $owner;
        }
    }
    
    public function getOwner()
    {
        return $this->_owner;
    }
    
    public function getIsProxy()
    {
        if (null === $this->_isProxy)
        {
            $this->_isProxy = (null !== $this->_instance && !($this->_instance instanceof $this));
        }
        return $this->_isProxy;
    }

    public function setInstance($value)
    {
        if (null === $this->_instance)
        {
            $this->_instance = $value;
        }
        
        if (null === $this->_instance && false !== is_object($value))
        {
            $this->abstract = array_merge($this->abstract, get_object_vars($value));
            $this->_instance = $value;
        }
    }

    public function getInstance()
    {
        if (null !== $this->_instance && !is_object($this->_instance))
        {
            $this->_instance = Yii::createComponent($this->_instance);
            $this->abstract = array_merge($this->abstract, get_object_vars($this->_instance));
        }
        return $this->_instance;
    }

    public function  __call($name, $parameters)
    {
        if (false !== $this->getIsProxy() && false !== method_exists($this->instance, $name))
        {
            $return = call_user_func_array(array($this->instance, $name), $parameters);
            return ($return === $this->instance) ? $this : $return;
        }

        return parent::__call($name, $parameters);
    }

    public function  __set($name, $value)
    {
        $setter='set'.$name;
        if (false !== method_exists($this, $setter))
        {
            return call_user_func_array(array($this, $setter), array($value));
        }
        else if (false !== property_exists($this, $name))
        {
            return $this->$name = $value;
        }
        else if (false !== $this->getIsProxy() && false !== method_exists($this->instance, $setter))
        {
            return call_user_func_array(array($this->instance, $setter), array($value));
        }
        else if (false !== $this->getIsProxy() && false !== property_exists($this->instance, $name))
        {
            return $this->instance->$name = $value;
        }
        else if (false === $this->getIsProxy() && false !== array_key_exists ($name, $this->abstract))
        {
            return $this->abstract[$name] = $value;
        }

        return parent::__set($name, $value);
    }

    public function  __get($name)
    {
        $getter='get'.$name;

        if (false !== method_exists($this, $getter))
        {
            return call_user_func(array($this, $getter));
        }
        else if (false !== property_exists($this, $name))
        {
            return $this->$name;
        }
        else if (false !== $this->getIsProxy() && false !== method_exists($this->instance, $getter))
        {
            return call_user_func(array($this->instance, $getter));
        }
        else if (false !== $this->getIsProxy() && false !== property_exists($this->instance, $name))
        {
            return $this->instance->$name;
        }
        else if (false === $this->getIsProxy() && false !== array_key_exists ($name, $this->abstract))
        {
            return $this->abstract[$name];
        }

        return parent::__get($name);
    }
}