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
class YiiDebugToolbarPanelApplication extends YiiDebugToolbarPanel
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

    public function run()
    {
        $this->render('application', array());
    }

    public function getControllersData()
    {
        $viewRenderer = Yii::app()->getComponent('viewRenderer');

        if ($viewRenderer instanceof YiiDebugViewRenderer)
        {
            $data = array();
            $debugStackTrace = $viewRenderer->debugStackTrace;

            foreach ($debugStackTrace as $class=>$callStack)
            {
                $reflection = new ReflectionClass($class);
                if($reflection->isSubclassOf('CController'))
                {
                    $data[$class] = new ArrayObject(array_merge($callStack, array(
                        'reflection'=>$reflection,
                    )));
                }
            }
            return $data;
        }
        return null;
    }

    public function getWidgetsData()
    {
        
    }

     /**
     * {@inheritdoc}
     */
    public function getMenuTitle()
    {
        return YiiDebug::t('Web Application');
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
        return YiiDebug::t('Web Application');
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return false;
    }
}