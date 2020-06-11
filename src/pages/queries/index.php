<?php

$value = "page 2";

include($_SERVER['DOCUMENT_ROOT']."/utils/url_parser.php");

$arr = filter_utm();

include($_SERVER['DOCUMENT_ROOT']."/services/TagService.php");

$tags = get_tags();

include($_SERVER['DOCUMENT_ROOT']."/utils/tag.php");

has_tag("My Tag PHP two", $tags);

?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>
        
        <?php foreach($tags as $item): ?>
            <p><?= $item ?></p>
        <?php endforeach; ?>
        
    </body>
</html>