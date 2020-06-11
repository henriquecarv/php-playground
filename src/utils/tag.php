<?php 

function has_tag(string $tag, $tags) {
    echo json_encode($tags[0]);
    $find_tag = function($item1) use ($tag, $tags) {
        if ($item1 === "") return "";

        return $key === "tag" && $tags[$key] === $tag;
    };

    $found = array_reduce($tags, $filter_tag, "");

    return $found;
}

?>