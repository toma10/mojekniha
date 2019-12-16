<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Tag;

class DeleteTagAction
{
    public function execute(Tag $tag): void
    {
        $tag->delete();
    }
}
