<?php

namespace App\Actions;

use App\DataTransferObjects\GenreData;
use App\Models\Genre;

class UpdateGenreAction
{
    public function execute(Genre $genre, GenreData $genreData): Genre
    {
        return tap($genre)->update($genreData->all());
    }
}
