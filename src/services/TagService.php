<?php 


function get_tags() {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $endPoint = "$activeCampaignUrl/tags";

    $curl = curl_init($endPoint);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $activeCampaignToken",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        echo $error;
        return '';
    }

    $jsonData = json_decode($response, true)['tags'];
    
    return $jsonData;
}



function create_tag(string $tag = "My php internal") {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $endPoint = "$activeCampaignUrl/tags";

    $curl = curl_init($endPoint);
    
    $post = json_encode(array("tag" => array("tag" => $tag, "tagType" => "contact", "description" => $tag)));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Api-Token: $activeCampaignToken",
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        echo $error;
        return '';
    }

    $jsonData = json_decode($response, true)['tag'];
    $createdTagName = $jsonData['tag'];
    $createdTagType = $jsonData['tagType'];
    
    echo $response;
}

?>