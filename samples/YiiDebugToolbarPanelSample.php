<?php
/**
 * YiiDebugToolbarPanelSample class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugToolbarPanelSample custom panel sample
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class YiiDebugToolbarPanelSample extends YiiDebugToolbarPanel
{

    public $test;

    public function getTitle()
    {
        return 'Sample panel';
    }

    public function getMenuTitle()
    {
        return 'Sample panel';
    }
}