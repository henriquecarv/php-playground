<?php

$value = "World";

include($_SERVER['DOCUMENT_ROOT']."/services/active_campaign.php");

$contacts = get_contacts()
?>

<html>
    <body>
        <h1>Hello, <?= $value ?>!</h1>
        <pre><?= $contacts ?></pre>
    </body>
</html>