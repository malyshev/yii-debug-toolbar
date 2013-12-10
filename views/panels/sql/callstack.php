<?php if (!empty($callstack)) :?>
<table data-ydtb-data-table>
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo Yii::t('yii-debug-toolbar','Query')?></th>
            <th nowrap="nowrap"><?php echo Yii::t('yii-debug-toolbar','Time (s)')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($callstack as $id=>$entry):?>
        <tr class="<?php echo ($entry[1]>$this->timeLimit ? ' warning':'') ?>">
            <td data-ydtb-data-type="number"><?php echo $id; ?></td>
            <td data-ydtb-data-type="varchar"><?php echo $entry[0]; ?></td>
            <td data-ydtb-data-type="number"><?php echo sprintf('%0.6F',$entry[1]); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p>
    <?php echo Yii::t('yii-debug-toolbar','No SQL queries were recorded during this request or profiling the SQL is DISABLED.')?>
</p>
<?php endif; ?>