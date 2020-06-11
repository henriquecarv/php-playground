<?php 


function get_vars() {
    $uri = $_SERVER['REQUEST_URI'];

    parse_str($uri, $output);

    return $output;
}

?>