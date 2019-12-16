<?php

namespace App\Http\Controllers;

use App\Domain\Book\Actions\CreateBookBindingAction;
use App\Domain\Book\Actions\DeleteBookBindingAction;
use App\Domain\Book\Actions\UpdateBookBindingAction;
use App\Domain\Book\DataTransferObjects\BookBindingData;
use App\Domain\Book\Models\BookBinding;
use App\Http\Requests\BookBindingRequest;
use App\Http\Resources\BookBindingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookBindingsController
{
    public function store(BookBindingRequest $request, CreateBookBindingAction $createBookBindingAction): JsonResponse
    {
        $bookBinding = $createBookBindingAction->execute(
            new BookBindingData($request->validated())
        );

        return (new BookBindingResource($bookBinding))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(
        BookBinding $bookBinding,
        BookBindingRequest $request,
        UpdateBookBindingAction $updateBookBindingAction
    ): JsonResource {
        $bookBinding = $updateBookBindingAction->execute(
            $bookBinding,
            new BookBindingData($request->validated())
        );

        return new BookBindingResource($bookBinding);
    }

    public function destroy(BookBinding $bookBinding, DeleteBookBindingAction $deleteBookBindingAction): JsonResponse
    {
        $deleteBookBindingAction->execute($bookBinding);

        return response()->json();
    }
}
