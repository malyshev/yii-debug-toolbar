Yii Debug Toolbar
=================

The Yii Debug Toolbar is a configurable set of panels that display various
debug information about the current request/response and when clicked, display
more details about the panel's content.

It is a ported to PHP famous [Django Debug Toolbar](/django-debug-toolbar/django-debug-toolbar/).

Currently, the following panels have been written and are working:

* Server info
* Request timer
* A list of superglobals
* Application settings
* SQL queries including time to execute and param bindings
* Logging output via Yii built-in logging


## Installation

Extract the [yii-debug-toolbar](/malyshev/yii-debug-toolbar/) from archive under protected/extensions

## Usage and Configuration

For use [yii-debug-toolbar](/malyshev/yii-debug-toolbar/) need to specify new `route` in `log` component:

```php
<?php
//...
    'log'=>array(
        'class'=>'CLogRouter',
        'routes'=>array(
            array(
                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                // Access is restricted by default to the localhost
                //'ipFilters'=>array('127.0.0.1','192.168.1.*', 88.23.23.0/24),
            ),
        ),
    ),
```

* Make sure your IP is listed in the `ipFilters` setting. If you are working locally this option not required.
* Enable [Profiling](http://www.yiiframework.com/doc/api/1.1/CDbConnection#enableProfiling-detail "") and [ParamLogging](http://www.yiiframework.com/doc/api/1.1/CDbConnection#enableParamLogging-detail "") for all used DB connections.

```php
<?php
//...
	'db'=>array(
	    'connectionString' => 'mysql:host=localhost;dbname=test',
	    //...
	    'enableProfiling'=>true,
	    'enableParamLogging'=>true,
	),
```

## TODOs and BUGS

See: [issues](https://github.com/malyshev/yii-debug-toolbar/issues)

## Working preview
<img src="https://dl.dropboxusercontent.com/u/6067542/yii-debug-toolbar/screenshot_1.png" alt="Screenshot1" />
<img src="https://dl.dropboxusercontent.com/u/6067542/yii-debug-toolbar/screenshot_2.png" alt="Screenshot2" />
<img src="https://dl.dropboxusercontent.com/u/6067542/yii-debug-toolbar/screenshot_3.png" alt="Screenshot3" />


