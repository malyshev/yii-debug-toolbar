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

    /**
     * Displays a variable.
     * This method achieves the similar functionality as var_dump and print_r
     * but is more robust when handling complex objects such as Yii controllers.
     * @param mixed $var variable to be dumped
     */
    public static function dump()
    {
        $args = func_get_args();

        if (php_sapi_name() == "cli") {
            foreach ($args as $k => $var) {
                var_dump($var);
                echo "\n";
            }
            return;
        } else if (empty($_SERVER['SERVER_ADDR']) || empty($_SERVER['REMOTE_ADDR']) || $_SERVER['SERVER_ADDR'] !== $_SERVER['REMOTE_ADDR']) {
            return;
        }

        $backTrace = debug_backtrace();
        $backTrace = array_shift($backTrace);
        echo '<div style="margin: 10px;border: 1px solid red;padding: 10px; background: #fff;">';
        if (is_array($backTrace) && isset($backTrace['file']) && isset($backTrace['function']) && $backTrace['function'] === __FUNCTION__) {
            echo "<b>{$backTrace['file']}</b> in line <b>{$backTrace['line']}</b> <br />";
            echo '<div style="border-bottom:1px solid #006699;margin: 5px 0;"></div>';
        }

        foreach ($args as $k => $var) {
            echo CVarDumper::dump($var, 10, true), '<br />';
        }

        echo "</div>";
    }

    /**
     * Writes a trace dump.
     * @param string $msg message to be logged
     */
    public static function trace($message)
    {
        Yii::trace(self::dump($message), 'dump');
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

    public static function t($str,$params=array(),$dic='yii-debug-toolbar') {
        return Yii::t("YiiDebug.".$dic, $str, $params);
    }
}
