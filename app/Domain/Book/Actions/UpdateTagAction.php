<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\TagData;
use App\Domain\Book\Models\Tag;

class UpdateTagAction
{
    public function execute(Tag $tag, TagData $tagData): Tag
    {
        return tap($tag)->update($tagData->all());
    }
}
