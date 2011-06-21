<?php
/**
 * YiiDebug class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @link http://www.vidomo.com/
 * @copyright Copyright &copy; 2000-2011 Vidomo
 * @license http://www.vidomo.com/terms-of-use
 */


/**
 * YiiDebug represents an ...
 *
 * Description of YiiDebug
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */

class YiiDebug extends CComponent
{
    public static function dump($var)
    {
        is_string($var)
            && $var = trim($var);
        return CVarDumper::dump($var, 10, true);
    }

    public static function trace($message)
    {
        Yii::trace(self::dump($message), 'dump');
    }
}
