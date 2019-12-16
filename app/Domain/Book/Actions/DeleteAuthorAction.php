<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Author;

class DeleteAuthorAction
{
    public function execute(Author $author): void
    {
        $author->delete();
    }
}
