<?php
/**
 * YiiDebugDbCommand class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * YiiDebugDbConnection represents an ...
 *
 * Description of YiiDebugDbConnection
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class YiiDebugDbConnection extends YiiDebugComponentProxy
{
    public $enableProfiling = true;
    
    public $enableParamLogging = true;
    
    public function init()
    {
        parent::init();
    }
    
    public function createCommand($query=null)
    {
        $command = $this->instance->createCommand($query);
        YiiDebug::getClassProperty($command, '_connection')->setValue($command, $this);
        return YiiDebug::proxyComponent($command, 
               YiiDebug::PATH_ALIAS . '.panels.sql.YiiDebugDbCommand', array(
                   'owner' => $this->owner,
               ));
    }
}