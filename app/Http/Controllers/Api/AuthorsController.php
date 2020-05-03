<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorsController
{
    public function show(Author $author): JsonResource
    {
        return new AuthorResource($author);
    }
}
