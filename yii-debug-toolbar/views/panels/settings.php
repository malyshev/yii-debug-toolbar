<h4>Application Properties</h4>
<table>
    <thead>
        <tr>
            <th width="180">Property</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0; foreach ($application as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>


<h4>Application Params</h4>
<table>
    <thead>
        <tr>
            <th width="180">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0; foreach ($params as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>


<h4>Modules</h4>
<table>
    <thead>
        <tr>
            <th width="180">Module ID</th>
            <th>Configuration</th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0; foreach ($modules as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>


<h4>Components</h4>
<table>
    <thead>
        <tr>
            <th width="180">Component ID</th>
            <th>Configuration</th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0; foreach ($components as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
