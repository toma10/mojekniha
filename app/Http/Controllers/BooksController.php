<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Actions\CreateBookAction;
use App\Actions\DeleteBookAction;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\DataTransferObjects\BookData;

class BooksController
{
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function store(BookRequest $request, CreateBookAction $createBookAction)
    {
        $book = $createBookAction->execute(
            new BookData($request->validated())
        );

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy(Book $book, DeleteBookAction $delteBookAction)
    {
        $delteBookAction->execute($book);

        return response()->json();
    }
}
