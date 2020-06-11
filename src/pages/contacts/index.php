<?php

include($_SERVER['DOCUMENT_ROOT']."/services/active_campaign.php");

$contacts = get_contacts();
?>

<html>
    <body>
        <pre><?= $contacts ?></pre>
    </body>
</html>