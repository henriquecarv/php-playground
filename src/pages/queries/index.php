<?php

$value = "page 2";

include($_SERVER['DOCUMENT_ROOT']."/services/TagService.php");

$test = json_encode(trigger_active_campaign());

?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>

         <p><?= $test  ?></p>
        

    </body>
</html>