<?php

namespace App\Http\Controllers;

use App\Actions\CreateBookBindingAction;
use App\Actions\DeleteBookBindingAction;
use App\Actions\UpdateBookBindingAction;
use App\DataTransferObjects\BookBindingData;
use App\Http\Requests\BookBindingRequest;
use App\Http\Resources\BookBindingResource;
use App\Models\BookBinding;
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
