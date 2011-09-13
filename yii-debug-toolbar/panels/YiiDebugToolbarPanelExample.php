<?php

class YiiDebugToolbarPanelExample extends YiiDebugToolbarPanel{
    function getMenuTitle(){ return YiiDebug::t('Blank'); }
    function getMenuSubTitle(){ return YiiDebug::t('Example panel'); }
    function getTitle(){ return YiiDebug::t('Blank page'); }
    function getSubTitle(){ return ''; }
	function run(){
		echo '<h4>'.YiiDebug::t('Blank page').'</h4>';
		echo YiiDebug::t('Example panel').'<br />';
        echo date('d.m.Y H:i');
	}
}