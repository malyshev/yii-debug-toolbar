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
    public function createCommand($query=null)
    {
        return YiiDebug::proxyComponent($this->instance->createCommand($query), 
               YiiDebug::PATH_ALIAS . '.panels.sql.YiiDebugDbCommand');
    }
}