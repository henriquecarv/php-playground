<?php

$value = "page 2";

include($_SERVER['DOCUMENT_ROOT']."/utils/url_parser.php");

$arr = get_vars();
?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>
        
        <?php foreach($arr as $item): ?>
            <p><?= $item ?></p>
        <?php endforeach; ?>
        
    </body>
</html>