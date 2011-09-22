<?php
/**
 * YiiDebugToolbarPanelViews class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

Yii::import('yii-debug-toolbar.components.YiiDebugViewRenderer');

/**
 * YiiDebugToolbarPanelViews represents an ...
 *
 * Description of YiiDebugToolbarPanelViews
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class YiiDebugToolbarPanelViews extends YiiDebugToolbarPanel
{


    public function init()
    {
        parent::init();

        $originalRenderer = Yii::app()->getComponent('viewRenderer');

        if (null !== ($originalRenderer))
        {
            Yii::app()->setComponent('viewRenderer', null);
        }

        Yii::app()->setComponents(array(
            'viewRenderer' => array(
                'class'=>'YiiDebugViewRenderer',
                'viewRenderer' => $originalRenderer
            )
        ), false);
    }

     /**
     * {@inheritdoc}
     */
    public function getMenuTitle()
    {
        return YiiDebug::t('View renderer');
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuSubTitle()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return YiiDebug::t('View renderer');
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return '(0)';
    }
}