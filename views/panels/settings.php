<div data-ydtb-panel-data="<?php echo $this->id ?>">
    <div>
        <div data-ydtb-accordion="<?php echo $this->id?>">
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($application)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Application Properties')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($application as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Modules')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($modules as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($params)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Application Params')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($params as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($components)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Components')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($components as $key => $value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
