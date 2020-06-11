<?php

class Tag {
    public ?string $id;
    public string $tag;
    public string $tagType;
    public string $description;

    public function __construct(string $tag, string $tage_type) {
        $this->tag = $tag;
        $this->tagType = $tag_type;
        $this->description = $tag;
    }
}

?>