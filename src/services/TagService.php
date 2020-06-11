<?php 


function get_tags() {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $end_point = "$active_campaign_url/tags";

    $curl = curl_init($end_point);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $active_campaign_token",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $error = curl_error($curl);

    if ($error !== '') {
        echo $error;
    }

    curl_close($curl);
    
    return $response;
}



function create_tag(string $tag) {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");
    include($_SERVER['DOCUMENT_ROOT']."/models/TagModel.php");

    $end_point = "$active_campaign_url/tags";

    $curl = curl_init($end_point);
    
    $post = [ "tag" => new Tag($tag, "contact")];

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, post);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $active_campaign_token",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $error = curl_error($curl);

    if ($error !== '') {
        echo $error;
    }

    curl_close($curl);

    $jsonData = json_decode($response, true)['tag'];
    $createdTagName = $jsonData['tag'];
    $createdTagType = $jsonData['tagType'];

    return new Tag($createdTagName, $createdTagType);
}

?>