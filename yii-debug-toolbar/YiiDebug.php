<?php

/**
 * YiiDebug class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebug class.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */
class YiiDebug extends CComponent
{

    const PATH_ALIAS = 'yii-debug-toolbar';
    const VIEWS_PATH = '/views/panels';

    private static $_route;

    public static function getDebugBacktrace()
    {
        // @see "http://www.php.net/manual/en/function.debug-backtrace.php"
        // 
        // debug_backtrace Changelog
        // 
        // Version  Description
        // 5.4.0    Added the optional parameter limit.
        // 5.3.6    The parameter provide_object changed to options and
        //          additional option DEBUG_BACKTRACE_IGNORE_ARGS is added.
        // 5.2.5    Added the optional parameter provide_object.
        // 5.1.1    Added the current object as a possible return element.
        if (version_compare(PHP_VERSION, '5.4.0', '>='))
        {
            // signature is:
            // array debug_backtrace ([ int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT [, int $limit = 0 ]] )
            // 
            // possible values for $options:
            // - DEBUG_BACKTRACE_PROVIDE_OBJECT
            // - DEBUG_BACKTRACE_IGNORE_ARGS
            // - DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS
            $debugBacktrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT);
        } elseif (version_compare(PHP_VERSION, '5.3.6', '>='))
        {
            // signature is:
            // array debug_backtrace ([ int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT ] )
            // 
            // possible values for $options:
            // - DEBUG_BACKTRACE_PROVIDE_OBJECT
            // - DEBUG_BACKTRACE_IGNORE_ARGS
            // - DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS
            $debugBacktrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT);
        } elseif (version_compare(PHP_VERSION, '5.2.5', '>='))
        {
            // signature is:
            // array debug_backtrace ([ bool $provide_object = TRUE ] )
            $debugBacktrace = debug_backtrace(true);
        } else /* version < 5.2.5 */
        {
            // signature is:
            // array debug_backtrace ( )
            $debugBacktrace = debug_backtrace();
        }

        return $debugBacktrace;
    }

    public static function setRoute(YiiDebugToolbarRoute $route)
    {
        if (null === self::$_route)
        {
            self::$_route = $route;
        }
    }

    public static function getRoute()
    {
        return self::$_route;
    }

    /**
     * Displays a variable.
     * This method achieves the similar functionality as var_dump and print_r
     * but is more robust when handling complex objects such as Yii controllers.
     * @param mixed $var variable to be dumped
     */
    public static function dump($var, $depth = 10)
    {
        is_string($var) && $var = trim($var);
        echo str_replace('&nbsp;', ' ', CVarDumper::dumpAsString($var, $depth, true));
    }

    /**
     * Writes a trace dump.
     * @param string $msg message to be logged
     */
    public static function trace($message)
    {
        Yii::trace(self::dump($message), 'dump');
    }
    
    public static function getClassOfAlias($alias)
    {
        if (false !== strpos($alias, '.'))
        {
            return substr(strrchr($alias, '.'), 1);
        }
        
        return $alias;
    }

    public static function proxyApplicationComponent($class, $proxy, $config = array())
    {
        $applicationComponents = Yii::app()->getComponents(false);
        $componentClass = null;
        foreach ($applicationComponents as $id => $component)
        {
            if (false !== is_array($component) && array_key_exists('class', $component))
            {
                $componentClass = self::getClassOfAlias($component['class']);
            } else if (false !== is_object($component))
            {
                $componentClass = get_class($component);
            } else if (false !== is_string($component))
            {
                $componentClass = $component;
            }
            

            if ($componentClass && (is_subclass_of($componentClass, $class) || $componentClass === $class))
            {
                if (is_object($component))
                {
                    Yii::app()->setComponent($id, null);
                }

                $config = array_merge($config, array(
                    'class' => $proxy,
                    'instance' => $component
                        ));

                Yii::app()->setComponent($id, $config, false);
            }
        }
    }

    public static function proxyComponent($class, $proxy, $config = array())
    {
        if (is_object($class))
        {
            $config = array_merge($config, array(
                'class' => $proxy,
                'instance' => $class
                    ));

            return Yii::createComponent($config);
        }
        return self::proxyApplicationComponent($class, $proxy, $config);
    }

    public static function proxyComponentById($id, $proxy, $config = array())
    {
        $applicationComponents = Yii::app()->getComponents(false);
        $component = null;
        
        if (array_key_exists($id, $applicationComponents))
        {
            $component = $applicationComponents[$id];
            if (is_object($component))
            {
                Yii::app()->setComponent($id, null);
            }
        }
        
        $config = array_merge($config, array(
            'class' => $proxy,
            'instance' => $component
        ));

        Yii::app()->setComponent($id, $config, false);
    }

    /**
     * 
     * @param mixed $class the name of the class to reflect, or an object.
     * @return ReflectionClass
     */
    public static function getClass($class)
    {
        return new ReflectionClass($class);
    }

    /**
     * 
     * @param mixed $class the name of the class to reflect, or an object.
     * @param string $name a class method name
     * @return ReflectionMethod
     */
    public static function getClassMethod($class, $name)
    {
        $class = self::getClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * 
     * @param mixed $class the name of the class to reflect, or an object.
     * @param string $name a class property name
     * @return ReflectionProperty
     */
    public static function getClassProperty($class, $name)
    {
        $class = self::getClass($class);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }

    public static function createCallback($action, $params = array(), $callback = null)
    {
        static $callbackId = 0;
        $callbackName = 'debug_callback_' . $callbackId;
        $cs = Yii::app()->clientScript;
        $url = Yii::app()->createUrl(self::getRoute()->controllerId . '/' . $action);
        $params = CJSON::encode($params);
        $callback = $callback;
        $callbackFunction = self::createCallbackFunction($url, $params, $callback);
        $cs->registerScript(__CLASS__ . '#1' . $callbackName, "var $callbackName = $callbackFunction");
        $callbackId++;
        return $callbackName . '(this)';
    }

    private static function createCallbackFunction($url, $params, $callback)
    {
        return <<<EOD
function(e){yiiDebugToolbar.callback(e, '$url', $params, $callback)}
EOD;
    }

    public static function t($str, $params = array(), $dic = 'yii-debug-toolbar')
    {
        return Yii::t("YiiDebug." . $dic, $str, $params);
    }

}
