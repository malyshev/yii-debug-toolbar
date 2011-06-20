<?php
/**
 * YiiDebugToolbar class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

Yii::setPathOfAlias('yii-debug-tolbar-panels', dirname(__FILE__) . '/panels');
Yii::import('yii-debug-tolbar-panels.*');

/**
 * YiiDebugToolbar represents an ...
 *
 * Description of YiiDebugToolbar
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugToolbar extends CWidget
{
    public $cssFile;
    
    private $_assetsUrl;

    private $_panels = array(
        'YiiDebugToolbarPanelServer',
        'YiiDebugToolbarPanelResourceUsage',
        'YiiDebugToolbarPanelGlobals',
        'YiiDebugToolbarPanelSettings',
        'YiiDebugToolbarPanelSql',
        'YiiDebugToolbarPanelLogging',
    );

    public function setPanels($panels)
    {
        $this->_panels = $panels;
    }

    public function getPanels()
    {
        return $this->_panels;
    }

    /**
     * @return string the base URL that contains all published asset files of gii.
     */
    public function getAssetsUrl()
    {
        if (null === $this->_assetsUrl)
            $this->_assetsUrl = Yii::app()
                ->getAssetManager()
                ->publish(dirname(__FILE__) . '/assets', false, -1, YII_DEBUG);
        return $this->_assetsUrl;
    }

    public function getLogs()
    {
        return $this->owner->logs;
    }

    /**
     * @param string $value the base URL that contains all published asset files of gii.
     */
    public function setAssetsUrl($value)
    {
            $this->_assetsUrl=$value;
    }
    public function init()
    {
        if (false === ($this->owner instanceof CLogRoute))
        {
            throw new CException('YiiDebugToolbar owner must be instance of CLogRoute');
        }

        $this->createPanels();

        $this->registerClientScripts();
    }

    public function run()
    {
        $this->render('yii_debug_toolbar', array(
            'panels' => $this->getPanels()
        ));
    }

    private function registerClientScripts()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('cookie');

        if (false !== $this->cssFile)
        {
            if (null === $this->cssFile)
                $this->cssFile = $this->assetsUrl . '/style.css';
            $cs->registerCssFile($this->cssFile);
        }

        $cs->registerScriptFile($this->assetsUrl . '/yii.debug.toolbar.js');
    }

    private function createPanels()
    {
        foreach ($this->panels as $id=>$config)
        {
            if (!is_object($config))
            {
                isset($config['class']) || $config['class'] = $id;
                $panel = Yii::createComponent($config, $this);
                if ($panel instanceof ToolbarPanelInterface)
                {
                    throw new CException(Yii::t('YiiDebugToolbar', 
                            'The %class% class must be compatible with DebugToolbarPanelInterface', array(
                                '%class%' => get_class($panel)
                            )));
                }
                $panel->init();
                $this->_panels[$id] = $panel;
            }
        }
    }
}


interface DebugToolbarPanelInterface
{
    public function getMenuTitle();

    public function getMenuSubTitle();

    public function getTitle();

    public function getSubTitle();
}
