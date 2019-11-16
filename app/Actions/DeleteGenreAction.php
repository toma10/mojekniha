<?php

namespace App\Actions;

use App\Models\Genre;

class DeleteGenreAction
{
    public function execute(Genre $genre): void
    {
        $genre->delete();
    }
}
