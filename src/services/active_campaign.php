<?php


function get_contacts() {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $end_point = "$active_campaign_url/contacts";

    $curl = curl_init($end_point);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $active_campaign_token",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);

    curl_close($curl);
    
    return $response;
}

?>