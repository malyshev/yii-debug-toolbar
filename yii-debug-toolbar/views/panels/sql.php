<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




?>

<script type="text/javascript">
$(function(){
    yiiDebugToolbar.showPanel(<?php echo CJavaScript::encode($this->id) ?>);
});
</script>


<ul class="yii-debug-toolbar-tabs">
    <li class="active" type="yii-debug-toolbar-sql-servers"><a href="javascript:;//">Connections</a></li>
    <li type="yii-debug-toolbar-sql-summary"><a href="javascript:;//">Summary</a></li>
    <li type="yii-debug-toolbar-sql-callstack"><a href="javascript:;//">Callstack</a></li>
</ul>

<div id="yii-debug-toolbar-sql-servers" class="tabscontent">
<?php

YiiDebug::dump(Yii::app()->db->getServerInfo());
YiiDebug::dump(Yii::app()->db->getServerVersion());
YiiDebug::dump(Yii::app()->db->getAttribute(PDO::ATTR_DRIVER_NAME));

?>

</div>


<?php if (!empty($summary)) : ?>
<table id="yii-debug-toolbar-sql-summary" class="tabscontent">
    <thead>
        <tr>
            <th>Query</th>
            <th nowrap="nowrap">Count</th>
            <th nowrap="nowrap">Total (s)</th>
            <th nowrap="nowrap">Avg. (s)</th>
            <th nowrap="nowrap">Min. (s)</th>
            <th nowrap="nowrap">Max. (s)</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($summary as $id=>$entry): ?>
        <tr class="<?php echo ($id%2?'odd':'even') ?>">
            <td width="100%"><?php echo CHtml::encode($entry[0]); ?></td>
            <td nowrap="nowrap" style="text-align: center;"><?php echo number_format($entry[1]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6f',$entry[4]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6f',$entry[4]/$entry[1]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6f',$entry[2]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6f',$entry[3]);?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p id="yii-debug-toolbar-sql-summary" class="tabscontent">No SQL queries were recorded during this request.</p>
<?php endif; ?>


<?php if (!empty($callstack)) : ?>
<table id="yii-debug-toolbar-sql-callstack" class="tabscontent">
    <thead>
        <tr>
            <th>Query</th>
            <th nowrap="nowrap">Time (s)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($callstack as $id=>$entry): ?>
        <tr class="<?php echo ($id%2?'odd':'even') ?>">
            <td width="100%"><?php echo CHtml::encode($entry[0]); ?></td>
            <td nowrap="nowrap"><?php echo sprintf('%0.6f',$entry[1]); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<p id="yii-debug-toolbar-sql-callstack" class="tabscontent">No SQL queries were recorded during this request.</p>
<?php endif; ?>