<?php

class YiiDebugToolbarPanelAssets extends YiiDebugToolbarPanel{
    function getMenuTitle(){ return YiiDebug::t('Assets'); }
    function getMenuSubTitle(){ return YiiDebug::t('Manage assets files'); }
    function getTitle(){ return YiiDebug::t('Assets Manager'); }
    function getSubTitle(){ return ''; }
	function run(){

        $AM = Yii::app()->getAssetManager();

        $assets = array();

        $dir = $AM->getBasePath();
        $obdir = opendir($dir);
        while(($file=readdir($obdir))!=false){
            if($file=='.'||$file=='..') continue;
            array_push($assets, $file);
        }
        closedir($obdir);

        $this->render('asset', array(
            'AM' => $AM,
            'assets' => $assets,
        ));

	}

}