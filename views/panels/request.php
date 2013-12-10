<div data-ydtb-panel-data="<?php echo $this->id ?>">
    <div>
        <div data-ydtb-accordion="<?php echo $this->id?>">
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($server)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Request Server Parameters')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php $c=0; foreach ($server as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($cookies)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Request Cookies')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table>
                        <tbody>
                            <?php foreach ($cookies as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($session)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Session Attributes')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($session as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($get)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Request GET Parameters')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($get as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($post)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Request POST Parameters')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($post as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <div data-ydtb-accordion-group="collapsed">
                <div data-ydtb-accordion-heading="" data-ydtb-data-size="<?php echo count($files)?>">
                    <i data-ydtb-icon="s"></i>
                    <span><?php echo YiiDebug::t('Request FILES')?></span>
                    <i data-ydtb-icon="q"></i>
                    <i data-ydtb-icon="t"></i>
                    <div class="clear clearfix"></div>
                </div>
                <div data-ydtb-accordion-body="">
                    <table data-ydtb-data-table="fixed">
                        <tbody>
                            <?php foreach ($files as $key=>$value) : ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $this->dump($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>

