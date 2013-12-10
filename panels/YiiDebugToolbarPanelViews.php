<?php
/**
 * YiiDebugToolbarPanelViews class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

Yii::import('yii-debug-toolbar.YiiDebugViewRenderer');

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
	public $i = 'l';
	
    private $_viewsCount = 0;

    private $_viewRenderer;

    public function getViewsCount()
    {
        return count($this->_viewRenderer->debugStackTrace);
    }

    public function init()
    {
        parent::init();
        $this->_viewRenderer = Yii::app()->getComponent('viewRenderer');
    }

    public function run()
    {
        $data = array();
        $viewRenderer = $this->_viewRenderer;

        if ($viewRenderer instanceof YiiDebugViewRenderer) {
            $data = $this->_viewRenderer->debugStackTrace;
        }

        $this->render('views', array('data'=>$data));
    }

    public function getInheritance(ReflectionClass $class)
    {
        $data = array();

        while($class = $class->getParentClass())
        {
            $data[] = $class->name;
            if('CBaseController' === $class->name)
                break;
        }

        return implode('&nbsp;&raquo;&nbsp;', $data);
    }

    public function getFilePath($file)
    {
        return trim(str_replace(Yii::getPathOfAlias('webroot'), '', $file), '\\/');
    }

    public function getFileAlias($file)
    {
        return str_replace(DIRECTORY_SEPARATOR, '.', 
                dirname(trim(str_replace(Yii::getPathOfAlias('webroot'), '', $file), '\\/')) . '/'
                . basename(trim(str_replace(Yii::getPathOfAlias('webroot'), '', $file), '\\/'), '.php'));
    }


    public function getWidgetsData()
    {
        
    }

     /**
     * {@inheritdoc}
     */
    public function getMenuTitle()
    {
        return YiiDebug::t('Views Rendering');
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuSubTitle()
    {
        return $this->viewsCount;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return YiiDebug::t('Views Rendering');
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return false;
    }
}