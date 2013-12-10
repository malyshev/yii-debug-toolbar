<?php if ($connections) : foreach($connections as $id=>$connection): ?>
<h2><?php echo Yii::t('yii-debug-toolbar','Connection ID')?>: <?php echo $id ?> (<?php echo get_class($connection)?>)</h2>
<?php $serverInfo = $this->getServerInfo($id);?>
    <table data-ydtb-data-table>
        <tbody>
        <?php if(is_array($serverInfo)): ?>
            <?php foreach($serverInfo as $param=>$value): ?>
            <tr>
                <th><?php echo CHtml::encode($param)?></th>
                <td><?php echo CHtml::encode($value)?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <th>Used DB driver doesn't provide info.</th>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
<?php endforeach; ?>
<?php else : ?>
No SQL Servers used during this request.
<?php endif;?>
