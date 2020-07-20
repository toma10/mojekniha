<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorsController
{
    public function index()
    {
        $authors = Author::latest()->paginate();

        return AuthorResource::collection($authors);
    }

    public function show(Author $author): JsonResource
    {
        $author->load(['books' => function ($query) {
            $query->reorder()->orderByDesc('release_year');
        }, 'series']);

        return new AuthorResource($author);
    }
}
