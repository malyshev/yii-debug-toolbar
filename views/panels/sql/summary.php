<?php if (!empty($summary)) :?>
<table data-ydtb-data-table>
    <thead>
        <tr>
            <th><?php echo Yii::t('yii-debug-toolbar','Query')?></th>
            <th><?php echo Yii::t('yii-debug-toolbar','Count')?></th>
            <th><?php echo Yii::t('yii-debug-toolbar','Total (s)')?></th>
            <th><?php echo Yii::t('yii-debug-toolbar','Avg. (s)')?></th>
            <th><?php echo Yii::t('yii-debug-toolbar','Min. (s)')?></th>
            <th><?php echo Yii::t('yii-debug-toolbar','Max. (s)')?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($summary as $id=>$entry):?>
        <tr class="<?php echo ($entry[1]>$this->countLimit || ($entry[4]/$entry[1] > $this->timeLimit) ?' warning':'') ?>">
            <td data-ydtb-data-type="varchar"><?php echo $entry[0]; ?></td>
            <td data-ydtb-data-type="number"><?php echo number_format($entry[1]); ?></td>
            <td data-ydtb-data-type="number"><?php echo sprintf('%0.6F',$entry[4]); ?></td>
            <td data-ydtb-data-type="number"><?php echo sprintf('%0.6F',$entry[4]/$entry[1]); ?></td>
            <td data-ydtb-data-type="number"><?php echo sprintf('%0.6F',$entry[2]); ?></td>
            <td data-ydtb-data-type="number"><?php echo sprintf('%0.6F',$entry[3]);?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p>
    <?php echo Yii::t('yii-debug-toolbar','No SQL queries were recorded during this request or profiling the SQL is DISABLED.')?>
</p>
<?php endif; ?>