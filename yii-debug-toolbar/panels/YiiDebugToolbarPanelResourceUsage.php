<?php
/**
 * YiiDebugToolbarPanelTime class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @link http://www.vidomo.com/
 * @copyright Copyright &copy; 2000-2011 Vidomo
 * @license http://www.vidomo.com/terms-of-use
 */


/**
 * YiiDebugToolbarPanelTime represents an ...
 *
 * Description of YiiDebugToolbarPanelTime
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugToolbarPanelResourceUsage extends YiiDebugToolbarPanel implements DebugToolbarPanelInterface
{
    private $_loadTime;

    public function getLoadTime()
    {
        if (null === $this->_loadTime)
        {
            $this->_loadTime = $this->owner->owner->getLoadTime();
        }
        return $this->_loadTime;
    }

    public function getRequestLoadTime()
    {
        return ($this->owner->owner->getEndTime()
                - $_SERVER['REQUEST_TIME']);
    }

    public function getMenuTitle()
    {
        return 'Time';
    }

    public function getMenuSubTitle()
    {
        return vsprintf('%0.6fS', array(
            $this->getLoadTime()
        ));
    }

    public function getTitle()
    {
        return 'Resource Usage';
    }

    public function run()
    {

        $resources =  array(
            'Page Load Time'=>sprintf('%0.3f S',$this->getLoadTime()),
            'Elapsed Time'=>sprintf('%0.3f S',$this->getRequestLoadTime()),
            'Memory Usage'=>  number_format(Yii::getLogger()->getMemoryUsage()/1024) . ' KB',
            'Memory Peak Usage'=>  number_format(memory_get_peak_usage()/1024) . ' KB',
        );

        if (function_exists('mb_strlen'))
        {
            $resources['Session Size'] = sprintf('%0.3f KB' ,mb_strlen(serialize($_SESSION))/1024);
        }

        $this->render('resource_usage', array(
            'resources' => $resources
        ));
    }
}
