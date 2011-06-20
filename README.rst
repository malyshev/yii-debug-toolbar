====================
Yii Debug Toolbar
====================

The Yii Debug Toolbar is a configurable set of panels that display various
debug information about the current request/response and when clicked, display
more details about the panel's content.

Currently, the following panels have been written and are working:

- Server info
- Request timer
- A list of superglobals
- Application settings
- SQL queries including time to execute and param bindings
- Logging output via Yii built-in logging


Installation
============

Extract the `yii-debug-toolbar` from archive under protected/extensions

Usage and Configuration
=============

For use `yii-debug-toolbar` need to specify new `route` in `log` component:

'log'=>array(
    'class'=>'CLogRouter',
    'routes'=>array(
	    array(
		    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
		    'ipFilters'=>array('127.0.0.1','192.168.1.215'),
	    ),
    ),
),


Make sure your IP is listed in the `ipFilters` setting. If you are working locally this option not required.


TODOs and BUGS
==============
See: https://github.com/malyshev/yii-debug-toolbar/issues
