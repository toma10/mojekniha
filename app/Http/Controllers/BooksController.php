<?php

namespace App\Http\Controllers;

use App\Domain\Book\Actions\CreateBookAction;
use App\Domain\Book\Actions\DeleteBookAction;
use App\Domain\Book\Actions\UpdateBookAction;
use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Book;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
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
