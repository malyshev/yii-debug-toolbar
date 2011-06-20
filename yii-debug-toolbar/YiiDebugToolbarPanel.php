<?php
/**
 * YiiDebugToolbarPanel class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */


/**
 * YiiDebugToolbarPanel represents an ...
 *
 * Description of YiiDebugToolbarPanel
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

abstract class YiiDebugToolbarPanel extends CWidget
{

    public function dump($var)
    {
        return YiiDebug::dump($var);
    }

    public function getSubTitle()
    {
    }

    public function getMenuSubTitle()
    {
    }

    public function getViewPath($checkTheme=false)
    {
        return dirname(__FILE__) . '/views/panels';
    }

    

}
