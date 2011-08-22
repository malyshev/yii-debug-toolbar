<div id="yii-debug-toolbar-sql-servers" class="tabscontent">
<?php if ($connections) : foreach($connections as $id=>$connection): ?>
<h4>Connection ID: <?php echo $id ?> (<?php echo get_class($connection)?>)</h4>
<?php $serverInfo = $this->getServerInfo($id); $c=1;?>
    <table>
        <tbody>
            <?php foreach($serverInfo as $param=>$value): ++$c;?>
            <tr class="<?php echo ($c%2?'odd':'even') ?>">
                <th><?php echo CHtml::encode($param)?></th>
                <td><?php echo CHtml::encode($value)?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php //YiiDebug::dump($info); ?>
<?php endforeach; ?>
<?php else : ?>
No SQL Servers used during this request.
<?php endif;?>
</div>