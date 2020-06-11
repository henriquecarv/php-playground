<?php 

include($_SERVER['DOCUMENT_ROOT']."/models/TagModel.php");

function has_tag(string $tag, Tag ...$tags) {
    $found = array_search($tag, $tags, true);

    return $found;
}

?>