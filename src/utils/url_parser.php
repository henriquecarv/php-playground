<?php 

function get_vars() {
    $uri = $_SERVER['REQUEST_URI'];

    $url_query = parse_url($uri, PHP_URL_QUERY);
    parse_str($url_query, $vars);

    return $vars;
}

function filter_utm($search = "utm_content") {
    $vars = get_vars();

    $filter_utm_vars = function($key) use ($search) {
        return strpos($key, $search) !== false;
    };

    $filteredUtms = array_filter(array_keys($vars), $filter_utm_vars);

    $utms = array_intersect_key($vars, array_flip($filteredUtms));

    list("utm_content" => $utmContent) = $utms;

    return $utmContent;
}

?>