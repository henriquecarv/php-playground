<?php 


function get_vars() {
    $uri = $_SERVER['REQUEST_URI'];

    $url_query = parse_url($uri, PHP_URL_QUERY);
    parse_str($url_query, $output);

    return $output;
}

function filter_utm($search = "utm_") {
    $vars = get_vars();

    $filter_utm_vars = function($key) use ($search) {
        return strpos($key, $search) !== false;
    };

    $utms = array_filter(array_keys($vars), $filter_utm_vars);

    return array_intersect_key($vars, array_flip($utms));
}

?>