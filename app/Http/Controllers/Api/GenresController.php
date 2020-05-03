<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Genre;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GenresController
{
    public function show(Genre $genre): JsonResource
    {
        return new GenreResource($genre);
    }
}
