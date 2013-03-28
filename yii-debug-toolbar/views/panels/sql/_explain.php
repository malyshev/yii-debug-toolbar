<table>
    <thead>
        <tr>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','ID')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Select Type')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Table')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Type')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Possible Keys')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Key')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Key Len')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Ref')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Rows')?></th>
            <th class="nowrap"><?php echo Yii::t('yii-debug-toolbar','Extra')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $row) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['select_type']; ?></td>
            <td><?php echo $row['table']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo str_replace(',', ', ', $row['possible_keys']); ?></td>
            <td><?php echo $row['key']; ?></td>
            <td><?php echo $row['key_len']; ?></td>
            <td><?php echo $row['ref']; ?></td>
            <td><?php echo $row['rows']; ?></td>
            <td><?php echo $row['Extra']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>