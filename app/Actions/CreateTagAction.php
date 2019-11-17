<?php

namespace App\Actions;

use App\Models\Tag;
use App\DataTransferObjects\TagData;

class CreateTagAction
{
    public function execute(TagData $tagData): Tag
    {
        return Tag::create($tagData->all());
    }
}
