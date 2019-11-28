<?php

namespace App\Http\Controllers;

use App\Models\BookBinding;
use Illuminate\Http\Response;
use App\Actions\CreateBookBindingAction;
use App\Actions\DeleteBookBindingAction;
use App\Actions\UpdateBookBindingAction;
use App\Http\Requests\BookBindingRequest;
use App\Http\Resources\BookBindingResource;
use App\DataTransferObjects\BookBindingData;

class BookBindingsController
{
    public function store(BookBindingRequest $request, CreateBookBindingAction $createBookBindingAction)
    {
        $bookBinding= $createBookBindingAction->execute(
            new BookBindingData($request->validated())
        );

        return (new BookBindingResource($bookBinding))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(BookBinding $bookBinding, BookBindingRequest $request, UpdateBookBindingAction $updateBookBindingAction)
    {
        $bookBinding = $updateBookBindingAction->execute(
            $bookBinding,
            new BookBindingData($request->validated())
        );

        return new BookBindingResource($bookBinding);
    }

    public function destroy(BookBinding $bookBinding, DeleteBookBindingAction $deleteBookBindingAction)
    {
        $deleteBookBindingAction->execute($bookBinding);

        return response()->json();
    }
}
