<?php 

/**
 * Retrieve URL query variables
 * 
 * @return array
 */ 
function get_vars() {
    $uri = $_SERVER['REQUEST_URI'];

    $url_query = parse_url($uri, PHP_URL_QUERY);
    parse_str($url_query, $vars);

    return $vars;
}

/**
 * Search for a query variable name
 * 
 * @param array  $vars  Query variables;
 * @param string  $search  Query variable name;
 * 
 * @return string|null Found variable
 */ 
function filter_utm(array $vars, string $search = "utm_content") {
    $filter_utm_vars = function($key) use ($search) {
        return strpos($key, $search) !== false;
    };

    $filteredUtms = array_filter(array_keys($vars), $filter_utm_vars);

    $utms = array_intersect_key($vars, array_flip($filteredUtms));

    list("utm_content" => $utmContent) = $utms;

    return $utmContent;
}

/**
 * API Request
 * 
 * @param string   $endpoint  API endpoint;
 * @param string?  $method  Request method "GET" or "POST";
 * @param array?   $post  Request method "GET" or "POST";
 * 
 * @return array|string Request response
 */ 
function request_api(string $endPoint, string $method = "GET", array $post = array()) {
    include($_SERVER['DOCUMENT_ROOT']."/config/environment.php");

    $endPoint = "$activeCampaignUrl/$endPoint";

    $curl = curl_init($endPoint);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);

    if ($method === "POST") {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }

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

    $jsonData = json_decode($response, true);
    
    return $jsonData;
}

/**
 * Checks if array of tags has a specific tag
 * 
 * @param array   $tags  Tags;
 * @param string  $tag   Tag name;
 * 
 * @return array|null Found tag
 */ 
function has_tag(array $tags, string $tag) {
    $tag_filter = function ($tagElement) use ($tag) {
        return $tagElement->tag === $tag;
    };

    $utmTag = array_filter($tags, $tag_filter);

    return $utmTag;
}

/**
 * Retrive Active Campaign tags
 * 
 * @return array Request response
 */ 
function get_tags(string $tag) {
    list("tags" => $tags) = request_api("tags?search=$tag");

    return $tags;
}

/**
 * Create new Active Campaign tag
 * 
 * @param string   $tag  Tag name;
 * @param string?  $tagType  Tag type;
 * @param string?   $tagDescription  Tag description;
 * 
 * @return string  Created tag name;
 */ 
function create_tag(string $tag = "benetest", string $tagType = "contact", string $tagDescription = "") {
    $post = json_encode(array("tag" => array("tag" => $tag, "tagType" => $tagType, "description" => $tagDescription)));

    list("tag" => $createdTag) = request_api("tags", "POST", $post);
    
    $createdTagName = $$createdTag['tag'];
    $createdTagType = $$createdTag['tagType'];
    
    return $createdTagName;
}


function trigger_active_campaign() {
    $vars = get_vars();
    $utm = filter_utm($vars);

    $tags = get_tags($utm);

    $hasTag = has_tag($tags, $utm) !== null;

    // if Tag does not exist
    if(hasTag !== 1) {
        create_tag($utm);
    }

    return $hasTag;
}

?>