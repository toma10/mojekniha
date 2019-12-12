<?php

namespace App\Actions;

use App\DataTransferObjects\GenreData;
use App\Models\Genre;

class CreateGenreAction
{
    public function execute(GenreData $genreData): Genre
    {
        return Genre::create($genreData->all());
    }
}
