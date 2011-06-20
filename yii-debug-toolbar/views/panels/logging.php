<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$colors=array(
    CLogger::LEVEL_PROFILE=>'#DFFFE0',
    CLogger::LEVEL_INFO=>'#FFFFDF',
    CLogger::LEVEL_WARNING=>'#FFDFE5',
    CLogger::LEVEL_ERROR=>'#FFC0CB',
);
?>
<table id="yii-debug-toolbar-log">
    <thead>
        <tr>
            <th>Message</th>
            <th nowrap="nowrap">Level</th>
            <th nowrap="nowrap">Category</th>
            <th nowrap="nowrap">Time</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($logs as $id=>$entry): ?>
        <tr class="<?php echo ($id%2?'odd':'even') ?>" 
            <?php if(isset($colors[$entry[1]])) : ?>style=" background:<?php echo $colors[$entry[1]]?>"<?php endif;?>>
            <td width="100%"><?php echo nl2br($entry[0]) ?></td>
            <td nowrap="nowrap" style="text-align: center;"><?php echo $entry[1]?></td>
            <td nowrap="nowrap"><?php echo $entry[2] ?></td>
            <td nowrap="nowrap"><?php echo date('H:i:s.',$entry[3]).sprintf('%06d',(int)(($entry[3]-(int)$entry[3])*1000000));?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>