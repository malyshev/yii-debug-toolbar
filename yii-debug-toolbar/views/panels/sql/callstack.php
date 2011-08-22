<?php if (!empty($callstack)) : ?>
<table id="yii-debug-toolbar-sql-callstack" class="tabscontent">
    <thead>
        <tr>
        	<th>ID</th>
            <th>Query</th>
            <th nowrap="nowrap">Time (s)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($callstack as $id=>$entry): ?>
        <tr class="<?php echo ($id%2?'odd':'even') ?>">
        	<td class="text-right"><?php echo $id; ?></td>
            <td width="100%"><?php echo CHtml::encode($entry[0]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6F',$entry[1]); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p id="yii-debug-toolbar-sql-callstack" class="tabscontent">
    No SQL queries were recorded during this request or profiling the SQL is DISABLED.
</p>
<?php endif; ?>