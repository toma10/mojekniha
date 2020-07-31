<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AuthorsController
{
    public function index()
    {
        $authors = QueryBuilder::for(Author::class)
            ->allowedFilters([
                AllowedFilter::exact('nationality.id'),
            ])
            ->with('nationality')
            ->paginate();

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
