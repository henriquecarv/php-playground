<?php 

function has_tag(string $tag, $tags) {
    
    $found = in_array(array("tag" => $tag), $tags);

    echo $found;

    return $found;
}

?>