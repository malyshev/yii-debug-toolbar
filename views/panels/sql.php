<div data-ydtb-tabs="<?php echo $this->id?>">
    <ul>
        <li><a href="#summary"><i data-ydtb-icon="s"></i><?php echo Yii::t('yii-debug-toolbar','Summary')?></a></li>
        <li><a href="#callstack"><i data-ydtb-icon="s"></i><?php echo Yii::t('yii-debug-toolbar','Callstack')?></a></li>
        <li><a href="#servers"><i data-ydtb-icon="s"></i><?php echo Yii::t('yii-debug-toolbar','Servers')?></a></li>
    </ul>
    <div data-ydtb-panel-data="<?php echo $this->id ?>">
            <div>
                <div data-ydtb-tab="servers">
                    <?php $this->render('sql/servers', array(
                        'connections'=>$connections
                    )) ?>
                </div>
                <div data-ydtb-tab="summary">
                    <?php $this->render('sql/summary', array(
                        'summary'=>$summary
                    )) ?>
                </div>
                <div data-ydtb-tab="callstack">
                    <?php $this->render('sql/callstack', array(
                        'callstack'=>$callstack
                    )) ?>
                </div>
            </div>
    </div>
</div>
