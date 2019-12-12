<?php

namespace App\Actions;

use App\DataTransferObjects\TagData;
use App\Models\Tag;

class UpdateTagAction
{
    public function execute(Tag $tag, TagData $tagData): Tag
    {
        return tap($tag)->update($tagData->all());
    }
}
