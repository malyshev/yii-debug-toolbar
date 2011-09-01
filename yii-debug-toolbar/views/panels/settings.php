<div class="col left">
    
    <h4 class="collapsible"><?=Yii::t('yii-debug-toolbar', 'Application Properties')?></h4>
    <table>
        <thead>
            <tr>
                <th width="180"><?=Yii::t('yii-debug-toolbar', 'Property')?></th>
                <th><?=Yii::t('yii-debug-toolbar', 'Value')?></th>
            </tr>
        </thead>
        <tbody>
            <?php $c=0; foreach ($application as $key=>$value) : ?>
            <tr class="<?php echo ($c%2?'odd':'even') ?>">
                <th><?php echo $key; ?></th>
                <td><?php echo $this->dump($value); ?></td>
            </tr>
            <?php ++$c; endforeach;?>
        </tbody>
    </table>

    <h4 class="collapsible"><?=Yii::t('yii-debug-toolbar', 'Modules')?></h4>
    <table>
        <thead>
            <tr>
                <th width="180"><?=Yii::t('yii-debug-toolbar', 'Module ID')?></th>
                <th><?=Yii::t('yii-debug-toolbar', 'Configuration')?></th>
            </tr>
        </thead>
        <tbody>
            <?php $c=0; foreach ($modules as $key=>$value) : ?>
            <tr class="<?php echo ($c%2?'odd':'even') ?>">
                <th><?php echo $key; ?></th>
                <td><?php echo $this->dump($value); ?></td>
            </tr>
            <?php ++$c; endforeach;?>
        </tbody>
    </table>

    <h4 class="collapsible"><?=Yii::t('yii-debug-toolbar', 'Application Params')?></h4>
    <table>
        <thead>
            <tr>
                <th width="180"><?=Yii::t('yii-debug-toolbar', 'Name')?></th>
                <th><?=Yii::t('yii-debug-toolbar', 'Value')?></th>
            </tr>
        </thead>
        <tbody>
            <?php $c=0; foreach ($params as $key=>$value) : ?>
            <tr class="<?php echo ($c%2?'odd':'even') ?>">
                <th><?php echo $key; ?></th>
                <td><?php echo $this->dump($value); ?></td>
            </tr>
            <?php ++$c; endforeach;?>
        </tbody>
    </table>

</div>

<div class="col right">

    <h4 class="collapsible"><?=Yii::t('yii-debug-toolbar', 'Components')?></h4>
    <table>
        <thead>
            <tr>
                <th width="180"><?=Yii::t('yii-debug-toolbar', 'Component ID')?></th>
                <th><?=Yii::t('yii-debug-toolbar', 'Configuration')?></th>
            </tr>
        </thead>
        <tbody>
            <?php $c=0; foreach ($components as $key=>$value) : ?>
            <tr class="<?php echo ($c%2?'odd':'even') ?>">
                <th><?php echo $key; ?></th>
                <td><?php echo $this->dump($value); ?></td>
            </tr>
            <?php ++$c; endforeach;?>
        </tbody>
    </table>

</div>






