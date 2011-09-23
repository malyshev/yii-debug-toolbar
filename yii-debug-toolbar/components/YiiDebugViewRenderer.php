<?php
/**
 * YiiDebugViewRenderer class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugViewRenderer represents an ...
 *
 * Description of YiiDebugViewRenderer
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class YiiDebugViewRenderer extends CViewRenderer
{

    private $_isProxy;

    private $_viewRenderer;

    private $_fileExtension = '.php';

    protected $_debugStackTrace = array();

    public function renderFile($context, $sourceFile, $data, $return)
    {
        $this->collectDebugInfo($context, $sourceFile, $data);

        if (false !== $this->getIsProxy())
        {
            return $this->viewRenderer->renderFile($context,$sourceFile,$data,$return);
        }
         return $context->renderInternal($sourceFile,$data,$return);
    }

    public function generateViewFile($sourceFile, $viewFile)
    {
        if (false !== $this->getIsProxy())
        {
            return $this->viewRenderer->generateViewFile($sourceFile, $viewFile);
        }
    }

    public function getFileExtension()
    {
        return $this->_fileExtension;
    }


    public function  __call($name, $parameters)
    {
        if (false !== $this->getIsProxy() && false !== method_exists($this->_viewRenderer, $name))
        {
            return call_user_func_array(array($this->_viewRenderer, $name), $parameters);
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
        else if (false !== $this->getIsProxy() && false !== method_exists($this->_viewRenderer, $setter))
        {
            return call_user_func_array(array($this->_viewRenderer, $setter), array($value));
        }
        else if (false !== $this->getIsProxy() && false !== property_exists($this->_viewRenderer, $name))
        {
            return $this->_viewRenderer->$name = $value;
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
        else if (false !== $this->getIsProxy() && false !== method_exists($this->_viewRenderer, $getter))
        {
            return call_user_func(array($this->_viewRenderer, $getter));
        }
        else if (false !== $this->getIsProxy() && false !== property_exists($this->_viewRenderer, $name))
        {
            return $this->_viewRenderer->$name;
        }

        return parent::__get($name);
    }

    public function init()
    {
    }

    public function getIsProxy()
    {
        if (null === $this->_isProxy)
        {
            $this->_isProxy = (null !== $this->_viewRenderer && !is_a($this->_viewRenderer, __CLASS__));
        }
        return $this->_isProxy;
    }

    public function setViewRenderer($value)
    {
        if (null === $this->_viewRenderer)
        {
            $this->_viewRenderer = $value;
        }
        else
            throw new CException(YiiDebug::t('View renderer already set.'));
    }

    public function getViewRenderer()
    {
        return $this->_viewRenderer;
    }

    protected function collectDebugInfo($context, $sourceFile, $data)
    {
        if(is_a($context, 'YiiDebugToolbar') || false !== ($context instanceof YiiDebugToolbarPanel))
            return;


        $contextClass = get_class($context);
        $backTrace = debug_backtrace(true);
        $backTraceItem = null;

        while($backTraceItem = array_shift($backTrace))
        {
            if($backTraceItem['object'] && is_a($backTraceItem['object'], get_class($context)) && in_array($backTraceItem['function'], array(
                'render',
                'renderPartial'
            )) )
            {
                break;
            }
        }


        if(false === isset($this->_debugStackTrace[$contextClass]))
        {
            $this->_debugStackTrace[$contextClass] = array();
        }

        array_push($this->_debugStackTrace[$contextClass], array(
            'context'=>$context,
            'sourceFile'=>$sourceFile,
            'data'=>$data,
            'backTrace'=>$backTraceItem
        ));
        
    }


    public function getDebugStackTrace()
    {
        return $this->_debugStackTrace;
    }

    
}