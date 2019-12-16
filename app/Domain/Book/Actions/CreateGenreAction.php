<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\GenreData;
use App\Domain\Book\Models\Genre;

class CreateGenreAction
{
    public function execute(GenreData $genreData): Genre
    {
        return Genre::create($genreData->all());
    }
}
