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
 * @author Igor Golovanov <igor.golovanov@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */
abstract class YiiDebugToolbarPanel extends CWidget
implements YiiDebugToolbarPanelInterface
{

    public function dump($var)
    {
        return YiiDebug::dump($var);
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuSubTitle()
    {
        return null;
    }

    public function getViewPath($checkTheme = false)
    {
        return dirname(__FILE__) . '/views/panels';
    }

    

}
