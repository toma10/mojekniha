<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Genre;

class DeleteGenreAction
{
    public function execute(Genre $genre): void
    {
        $genre->delete();
    }
}
