<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksController
{
    public function index()
    {
        $books = Book::latest()->paginate();

        return BookResource::collection($books);
    }

    public function show(Book $book): JsonResource
    {
        return new BookResource($book);
    }
}
