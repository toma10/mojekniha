<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\TagData;
use App\Domain\Book\Models\Tag;

class CreateTagAction
{
    public function execute(TagData $tagData): Tag
    {
        return Tag::create($tagData->all());
    }
}
