<?php

namespace App\Actions;

use App\Models\Genre;
use App\DataTransferObjects\GenreData;

class UpdateGenreAction
{
    public function execute(Genre $genre, GenreData $genreData): Genre
    {
        return tap($genre)->update($genreData->all());
    }
}
