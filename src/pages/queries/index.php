<?php

$value = "page 2";

include($_SERVER['DOCUMENT_ROOT']."/services/TagService.php");

$vars = get_vars();
$utm = filter_utm($vars);

$tags = get_tags();

?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>

        <p><?= $utm  ?></p>

        <p><?= $tags  ?></p>
        

    </body>
</html>