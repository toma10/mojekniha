<?php

namespace App\Actions;

use App\Models\Tag;

class DeleteTagAction
{
    public function execute(Tag $tag): void
    {
        $tag->delete();
    }
}
