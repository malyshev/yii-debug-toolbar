<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../../yii-1.1.8.r3324/framework/yii.php';
$config=dirname(__FILE__).'/../../protected/config/main.php';

error_reporting(E_ALL);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);

function RemoveDir($path){
	if(file_exists($path) && is_dir($path)){
		$dirHandle = opendir($path);
		while (false !== ($file = readdir($dirHandle))) {
			if ($file!='.' && $file!='..'){
				$tmpPath=$path.'/'.$file;
				chmod($tmpPath, 0777);
				if (is_dir($tmpPath)){
					RemoveDir($tmpPath);
				}else{
					if(file_exists($tmpPath)){
						unlink($tmpPath);
					}
				}
			}
		}
		closedir($dirHandle);
		if(file_exists($path)){
			rmdir($path);
		}
	}else{
		throw new Exception(YiiDebug::t('Failed to delete folder.'));
	}
}

$AMBasePath = $_SERVER['DOCUMENT_ROOT'].'/assets';

$result = 'unknow';
if(isset($_GET['deleteasset'])){
	$id = substr($_GET['deleteasset'],0,60);
	$result = 'notexists';
	if(file_exists($AMBasePath.'/'.$id) && is_dir($AMBasePath.'/'.$id)){
		RemoveDir($AMBasePath.'/'.$id);
		$result = 'ok';
	}
}

echo json_encode($result);