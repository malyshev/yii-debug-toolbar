<?php
/**
 * application file.
 * 
 * Description of application file
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */


$index = 1;
?>

<div data-ydtb-panel-data="<?php echo $this->id ?>">
    <div>
        <div data-ydtb-accordion="<?php echo $this->id?>">
            <?php foreach ($data as $id=>$item) : ?>
                <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Context')?> <?php echo CHtml::encode(get_class($item['context']))?></span>
                    <?php // echo $this->getFileAlias($item['sourceFile']) ?>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                        <table data-ydtb-data-table>
                            <tbody>
                                <tr>
                                    <th>Context class</th>
                                    <td><?php echo CHtml::encode(get_class($item['context']))?></td>
                                </tr>
                                <tr>
                                    <th>Inheritance</th>
                                    <td><?php echo $this->getInheritance($item['reflection'])?></td>
                                </tr>
                                <tr>
                                    <th>Defined in file</th>
                                    <td><?php echo $this->getFilePath($item['reflection']->getFileName()) ?></td>
                                </tr>
                        
                                <tr>
                                    <th>Context properties</th>
                                    <td>
                                        <ul>
                                            <?php if ($item['contextProperties']) : foreach($item['contextProperties'] as $key=>$value) : ?>
                                            <li>
                                                <label><?php YiiDebug::dump($key, 1) ?></label>
                                                &nbsp;=>&nbsp;
                                                <span><label><?php YiiDebug::dump($value, 0) ?></label></span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                            <?php YiiDebug::dump(null) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        
                                <?php if(null!==$item['action']): ?>
                                <tr>
                                    <th>Route</th>
                                    <td><?php echo $item['route'] ?></td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td><?php echo get_class($item['action']) , '&nbsp;(' , $item['action']->getId() , ')'  ?></td>
                                </tr>
                        
                                <tr>
                                    <th>Action params</th>
                                    <td>
                                        <ul>
                                            <?php if ($item['actionParams']) : foreach($item['actionParams'] as $key=>$value) : ?>
                                            <li>
                                                <label><?php YiiDebug::dump($key, 1) ?></label>
                                                &nbsp;=>&nbsp;
                                                <span><label><?php YiiDebug::dump($value, 0) ?></label></span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                            <?php YiiDebug::dump(null) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Render method</th><td><?php echo $item['backTrace']['function'] ?></td>
                                </tr>
                                <tr>
                                    <th>View file</th>
                                    <td><?php echo $this->getFilePath($item['sourceFile']) ?></td>
                                </tr>
                        
                                <?php if(!(1===count($item['data']) && isset($item['data']['content']))): ?>
                                <tr>
                                    <th>View data</th>
                                    <td>
                                        <ul>
                                            <?php if ($item['data']) : foreach($item['data'] as $key=>$value) : ?>
                                            <li>
                                                <label><?php YiiDebug::dump($key, 1) ?></label>
                                                &nbsp;=>&nbsp;
                                                <span><label><?php YiiDebug::dump($value, 0) ?></label></span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                            <?php YiiDebug::dump(null) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>   
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


