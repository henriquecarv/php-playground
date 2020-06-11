<?php

$value = "page 2";

include($_SERVER['DOCUMENT_ROOT']."/utils/url_parser.php");

$uri = getUri();
?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>
        
        <p>URI: <?= $uri?></p>
    </body>
</html>