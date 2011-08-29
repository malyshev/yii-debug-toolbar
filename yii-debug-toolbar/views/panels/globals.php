<?php
/*
<table>
    <thead>
        <tr>
            <th>fghfgh</th>
            <th>fghfgh</th>
        </tr>
    </thead>
    <tbody>
        <tr class="even">
            <td>sad</td>
            <td>sdf</td>
        </tr>
        <tr class="odd">
            <td>gh</td>
            <td>fgh</td>
        </tr>
    </tbody>
</table>
 */
?>

<h4 class="collapsible">SERVER Variables</h4>
<table id="debug-toolbar-globals-server">
    <thead>
        <tr>
            <th width="300">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0; foreach ($server as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>

<?php if ($cookies) : $c=0;?>
<h4 class="collapsible">COOKIES Variables</h4>
<table id="debug-toolbar-globals-cookies">
    <thead>
        <tr>
            <th width="300">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cookies as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
<?php else : ?>
<h4>COOKIES Variables</h4>
No COOKIE data
<?php endif; ?>


<?php if ($session) : $c=0; ?>
<h4 class="collapsible">SESSION Variables</h4>
<table id="debug-toolbar-globals-session">
    <thead>
        <tr>
            <th width="300">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($session as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
<?php else : ?>
<h4>SESSION Variables</h4>
No SESSION data
<?php endif; ?>


<?php if ($get) : $c=0; ?>
<h4 class="collapsible">GET Variables</h4>
<table id="debug-toolbar-globals-get">
    <thead>
        <tr>
            <th width="300">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($get as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
<?php else : ?>
<h4>GET Variables</h4>
No GET data
<?php endif; ?>

<?php if ($post) : $c=0; ?>
<h4 class="collapsible">POST Variables</h4>
<table id="debug-toolbar-globals-post">
    <thead>
        <tr>
            <th width="300">Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($post as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
<?php else : ?>
<h4>POST Variables</h4>
No POST data
<?php endif; ?>


<?php if ($files) : $c=0; ?>
<h4 class="collapsible">FILES</h4>
<table id="debug-toolbar-globals-files">
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $key=>$value) : ?>
        <tr class="<?php echo ($c%2?'odd':'even') ?>">
            <th><?php echo $key; ?></th>
            <td><?php echo $this->dump($value); ?></td>
        </tr>
        <?php ++$c; endforeach;?>
    </tbody>
</table>
<?php else : ?>
<h4>FILES</h4>
No FILES data
<?php endif; ?>
<br /><br />
