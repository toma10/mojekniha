<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\GenreData;
use App\Domain\Book\Models\Genre;

class UpdateGenreAction
{
    public function execute(Genre $genre, GenreData $genreData): Genre
    {
        return tap($genre)->update($genreData->all());
    }
}
