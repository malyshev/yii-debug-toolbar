<?

class YiiDebugToolbarPanelExample extends YiiDebugToolbarPanel{
    function getMenuTitle(){ return Yii::t('yii-debug-toolbar', 'Blank'); }
    function getMenuSubTitle(){ return Yii::t('yii-debug-toolbar', 'Example panel'); }
    function getTitle(){ return Yii::t('yii-debug-toolbar', 'Blank page'); }
    function getSubTitle(){ return ''; }
	function run(){
		echo '<h4>'.Yii::t('yii-debug-toolbar', 'Blank page').'</h4>';
		echo Yii::t('yii-debug-toolbar', 'Example panel').'<br />';
        echo date('d.m.Y H:i');
	}
}