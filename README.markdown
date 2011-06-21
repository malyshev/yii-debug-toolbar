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

``` php
<?php
//...
    'log'=>array(
        'class'=>'CLogRouter',
        'routes'=>array(
            array(
                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                'ipFilters'=>array('127.0.0.1','192.168.1.215'),
            ),
        ),
    ),
```

* Make sure your IP is listed in the `ipFilters` setting. If you are working locally this option not required.
* Enable [Profiling](http://www.yiiframework.com/doc/api/1.1/CDbConnection#enableProfiling-detail "") and [ParamLogging](http://www.yiiframework.com/doc/api/1.1/CDbConnection#enableParamLogging-detail "") for all used DB connections.


## TODOs and BUGS

See: [issues](/malyshev/yii-debug-toolbar/issues)

## Working preview
<img src="http://farm3.static.flickr.com/2672/5853614867_a0dc947c43_z.jpg" alt="Screenshot1" />
<img src="http://farm6.static.flickr.com/5101/5854171184_9312bf5f18_z.jpg" alt="Screenshot2" />


