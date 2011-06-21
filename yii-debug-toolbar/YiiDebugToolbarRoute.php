<?php
/**
 * YiiDebugToolbarRouter class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */


/**
 * YiiDebugToolbarRouter represents an ...
 *
 * Description of YiiDebugToolbarRouter
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package YiiDebugToolbar
 * @since 1.1.7
 */
class YiiDebugToolbarRoute extends CLogRoute
{

    public $ipFilters=array('127.0.0.1','::1');

    private $_toolbarWidget,
            $_startTime,
            $_endTime;


    public function getStartTime()
    {
        return $this->_startTime;
    }

    public function getEndTime()
    {
        return $this->_endTime;
    }

    public function getLoadTime()
    {
        return ($this->endTime-$this->startTime);
    }

    protected function getToolbarWidget()
    {
        if (null === $this->_toolbarWidget)
        {
            $this->_toolbarWidget = Yii::createComponent('YiiDebugToolbar', $this);
        }
        return $this->_toolbarWidget;
    }

    public function init()
    {
        $this->_startTime=microtime(true);

        parent::init();

        $this->enabled && $this->enabled = ($this->allowIp(Yii::app()->request->userHostAddress)
                && !Yii::app()->getRequest()->getIsAjaxRequest());

        if ($this->enabled)
        {
            Yii::app()->attachEventHandler('onBeginRequest', array($this, 'onBeginRequest'));
            Yii::app()->attachEventHandler('onEndRequest', array($this, 'onEndRequest'));
            Yii::setPathOfAlias('yii-debug-toolbar', dirname(__FILE__));
            Yii::import('yii-debug-toolbar.*');
            $this->categories = '';
            $this->levels='';
        }

    }

    protected function onBeginRequest($event)
    {
        $this->getToolbarWidget()->init();
    }

    protected function onEndRequest($event)
    {
        
    }

    public function collectLogs($logger, $processLogs=false)
    {
        parent::collectLogs($logger, $processLogs);
    }

    protected function processLogs($logs)
    {
        $this->_endTime = microtime(true);
        $this->enabled && $this->getToolbarWidget()->run();
    }

    /**
     * Checks to see if the user IP is allowed by {@link ipFilters}.
     * @param string $ip the user IP
     * @return boolean whether the user IP is allowed by {@link ipFilters}.
     */
    protected function allowIp($ip)
    {
        if(empty($this->ipFilters))
            return false;
        foreach($this->ipFilters as $filter)
        {
            if($filter==='*' || $filter===$ip || (($pos=strpos($filter,'*'))!==false && !strncmp($ip,$filter,$pos)))
                    return true;
        }
        return false;
    }
}