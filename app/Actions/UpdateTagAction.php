<?php

namespace App\Actions;

use App\Models\Tag;
use App\DataTransferObjects\TagData;

class UpdateTagAction
{
    public function execute(Tag $tag, TagData $tagData): Tag
    {
        return tap($tag)->update($tagData->all());
    }
}
