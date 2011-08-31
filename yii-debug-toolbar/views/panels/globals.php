<div class="col left">

    <h4 class="collapsible">SERVER Variables</h4>
    <table id="debug-toolbar-globals-server">
        <thead>
            <tr>
                <th>Name</th>
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
                <th>Name</th>
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
                <th>Name</th>
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

</div>

<div class="col right">

    <?php if ($get) : $c=0; ?>
    <h4 class="collapsible">GET Variables</h4>
    <table id="debug-toolbar-globals-get">
        <thead>
            <tr>
                <th>Name</th>
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
                <th>Name</th>
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

</div>
