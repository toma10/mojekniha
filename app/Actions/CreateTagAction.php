<?php

namespace App\Actions;

use App\DataTransferObjects\TagData;
use App\Models\Tag;

class CreateTagAction
{
    public function execute(TagData $tagData): Tag
    {
        return Tag::create($tagData->all());
    }
}
