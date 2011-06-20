<?php
/**
 * YiiDebugToolbarPanelRequest class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */


/**
 * YiiDebugToolbarPanelRequest represents an ...
 *
 * Description of YiiDebugToolbarPanelRequest
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugToolbarPanelGlobals extends YiiDebugToolbarPanel implements DebugToolbarPanelInterface
{
    public function getMenuTitle()
    {
        return 'Globals';
    }

    public function getTitle()
    {
        return 'Global Variables';
    }

    public function init()
    {
        
    }

    public function run()
    {
        $this->render('globals', array(
            'server' => $_SERVER,
            'cookies' => $_COOKIE,
            'session' => $_SESSION,
            'post' => $_POST,
            'get' => $_GET,
            'files' => $_FILES,
        ));
    }
}
