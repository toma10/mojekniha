<?php

namespace App\Http\Controllers;

use App\Actions\CreateBookAction;
use App\Actions\DeleteBookAction;
use App\Actions\UpdateBookAction;
use App\DataTransferObjects\BookData;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BooksController
{
    public function show(Book $book): JsonResource
    {
        return new BookResource($book);
    }

    public function store(BookRequest $request, CreateBookAction $createBookAction): JsonResponse
    {
        $book = $createBookAction->execute(
            new BookData($request->validated())
        );

        return (new BookResource($book))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Book $book, BookRequest $request, UpdateBookAction $updateBookAction): JsonResource
    {
        $book = $updateBookAction->execute(
            $book,
            new BookData($request->validated())
        );

        return new BookResource($book);
    }

    public function destroy(Book $book, DeleteBookAction $delteBookAction): JsonResponse
    {
        $delteBookAction->execute($book);

        return response()->json();
    }
}
