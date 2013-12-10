<?php

/**
 * YiiDebugToolbarResourceUsage class file.
 *
 * @author Sergey Malyshev <malyshev@zfort.net>
 */

/**
 * YiiDebugToolbarResourceUsage represents an ...
 *
 * Description of YiiDebugToolbarResourceUsage
 *
 * @author Sergey Malyshev <malyshev@zfort.net>
 * @package
 * @since 1.1.7
 */
class YiiDebugToolbarResourceUsage extends CWidget
{

    public $htmlOptions = array();
    private $_loadTime;

    public function getLoadTime()
    {
        if (null === $this->_loadTime) {
            $this->_loadTime = $this->owner->owner->getLoadTime();
        }
        return $this->_loadTime;
    }

    public function getRequestLoadTime()
    {
        return ($this->owner->owner->getEndTime() - $_SERVER['REQUEST_TIME']);
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {

        $data = array();

        $data[] = array(
            'i' => 'b',
            'value' => sprintf('%0.4F', $this->getLoadTime()),
            'unit' => 'seconds'
        );

        $data[] = array(
            'i' => 'a',
            'value' => sprintf('%0.4F', $this->getRequestLoadTime()),
            'unit' => 'seconds'
        );

        $memoryUsage = number_format(Yii::getLogger()->getMemoryUsage() / 1024 / 1024, 2);

        if (function_exists('memory_get_peak_usage')) {
            $memoryUsage .= '/' . number_format(memory_get_peak_usage() / 1024 / 1024, 2);
        }

        $data[] = array(
            'i' => 'p',
            'value' => $memoryUsage,
            'unit' => 'megabytes'
        );


        $this->render('resources', array(
            'data' => $data
        ));
    }

}