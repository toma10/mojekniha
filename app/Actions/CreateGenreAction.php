<?php

namespace App\Actions;

use App\Models\Genre;
use App\DataTransferObjects\GenreData;

class CreateGenreAction
{
    public function execute(GenreData $genreData): Genre
    {
        return Genre::create($genreData->all());
    }
}
