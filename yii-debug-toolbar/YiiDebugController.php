<?php
/**
 * YiiDebugController class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugController class.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */

class YiiDebugController extends CController
{
    public function actions()
    {
        $actions = array();
        foreach (YiiDebug::getRoute()->getPanels() as $panelClass)
        {
            $actionPrefix = strtolower(preg_replace('/^YiiDebugToolbarPanel/', '', $panelClass)) . '.';
            $actions[$actionPrefix] = array(
                'class' => YiiDebug::PATH_ALIAS . '.panels.' . $panelClass,
                'actionPrefix' => $actionPrefix
            );
        }
        return $actions;
    }
}