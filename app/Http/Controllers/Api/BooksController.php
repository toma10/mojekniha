<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BooksController
{
    public function index()
    {
        $books = QueryBuilder::for(Book::class)
            ->allowedFilters([
                AllowedFilter::exact('genres.id'),
                AllowedFilter::exact('tags.id'),
            ])
            ->with('author')
            ->latest()
            ->paginate();

        return BookResource::collection($books);
    }

    public function show(Book $book): JsonResource
    {
        $book->load('author', 'series', 'tags', 'genres');

        return new BookResource($book);
    }
}
