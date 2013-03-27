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
    
    private static $_route;
    
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
    public static function dump($var, $depth=10)
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
    
    public static function proxyApplicationComponent($class, $proxy)
    {
        $applicationComponents = Yii::app()->getComponents(false);
        $componentClass = null;
        foreach ($applicationComponents as $id=>$component)
        {
            if (false !== is_array($component) && array_key_exists('class', $component))
            {
                $componentClass = $component['class'];
            }
            else if (false !== is_object($component))
            {
                $componentClass = get_class($component);
            }
            else if (false !== is_string($component))
            {
                $componentClass = $component;
            }
            
            if ($componentClass && (is_subclass_of($componentClass, $class) || $componentClass === $class))
            {
                if (is_object($component))
                {
                    Yii::app()->setComponent($id, null);
                }
                
                Yii::app()->setComponent($id, array(
                    'class' => $proxy,
                    'instance' => $component
                ), false);
            }
        }
    }

    public static function proxyComponent($class, $proxy)
    {
        if (is_object($class))
        {
            return Yii::createComponent(array(
                    'class' => $proxy,
                    'instance' => $class
            ));
        }
        return self::proxyApplicationComponent($class, $proxy);
    }
    
    public static function proxyComponentById($id, $proxy)
    {
        $applicationComponents = Yii::app()->getComponents(false);
        if (array_key_exists($id, $applicationComponents))
        {
            $component = $applicationComponents[$id];
            if (is_object($component))
            {
                Yii::app()->setComponent($id, null);
            }
            
            Yii::app()->setComponent($id, array(
                'class' => $proxy,
                'instance' => $component
            ), false);
        }
    }

    public static function getClass($class)
    {
        return new ReflectionClass($class);
    }

    public static function getClassMethod($class,$name)
    {
        $class = self::getClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
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
        $cs->registerScript(__CLASS__.'#1'.$callbackName, "var $callbackName = $callbackFunction");
        $callbackId++;
        return $callbackName . '(this)';
    }
    
    private static function createCallbackFunction($url, $params, $callback)
    {
        return <<<EOD
function(e){yiiDebugToolbar.callback(e, '$url', $params, $callback)}
EOD;
    }    
    
    public static function t($str,$params=array(),$dic='yii-debug-toolbar') {
        return Yii::t("YiiDebug.".$dic, $str, $params);
    }
}
