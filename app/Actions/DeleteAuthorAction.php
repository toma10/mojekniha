<?php

namespace App\Actions;

use App\Models\Author;

class DeleteAuthorAction
{
    public function execute(Author $author): void
    {
        $author->delete();
    }
}
