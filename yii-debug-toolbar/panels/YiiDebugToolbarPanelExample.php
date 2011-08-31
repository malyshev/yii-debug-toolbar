<?

class YiiDebugToolbarPanelExample extends YiiDebugToolbarPanel{
    function getMenuTitle(){ return 'Blank'; }
    function getMenuSubTitle(){ return 'Example panel'; }
    function getTitle(){ return 'Blank page'; }
    function getSubTitle(){ return ''; }
	function run(){
		echo '<h4>Blank page</h4>';
		echo 'Example panel<br />';
        echo date('d.m.Y H:i');
	}
}