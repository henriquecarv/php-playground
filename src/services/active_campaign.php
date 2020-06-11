<?php

function get_contacts() {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $endPoint = "$activeCampaignUrl/contacts";

    $curl = curl_init($endPoint);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $activeCampaignToken",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);

    curl_close($curl);
    
    return $response;
}



?>