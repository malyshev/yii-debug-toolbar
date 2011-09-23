<?php
/**
 * controller file.
 * 
 * Description of controller file
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
?>
<?php foreach ($data as $class=>$callStack) : ?>
<h4 class="collapsible"><?php echo YiiDebug::t('Controller')?>&nbsp;<?php echo CHtml::encode($class)?></h4>
<table>
    <tbody>
        <tr class="even">
            <th>Controller Class</th>
            <td><?php echo CHtml::encode($class)?></td>
        </tr>
        <tr class="even">
            <th>Defined in</th>
            <td><?php echo $callStack['reflection']->getFileName() ;?></td>
        </tr>
        <tr class="even">
            <th>Subclass of</th>
            <td><?php echo $callStack['reflection']->getParentClass()->name ;?></td>
        </tr>
    </tbody>
</table>
<?php endforeach; ?>