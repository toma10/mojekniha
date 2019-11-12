<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Actions\CreateBookAction;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\DataTransferObjects\BookData;

class BooksController
{
    public function show(Book $book)
    {
        return new BookResource($book);
    }
}
