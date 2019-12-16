<?php

namespace App\Http\Controllers;

use App\Domain\Book\Actions\CreateAuthorAction;
use App\Domain\Book\Actions\DeleteAuthorAction;
use App\Domain\Book\Actions\UpdateAuthorAction;
use App\Domain\Book\DataTransferObjects\AuthorData;
use App\Domain\Book\Models\Author;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class AuthorsController
{
    public function show(Author $author): JsonResource
    {
        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request, CreateAuthorAction $createAuthorAction): JsonResponse
    {
        $author = $createAuthorAction->execute(
            new AuthorData($request->validated())
        );

        return (new AuthorResource($author))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Author $author, AuthorRequest $request, UpdateAuthorAction $updateAuthorAction): JsonResource
    {
        $author = $updateAuthorAction->execute(
            $author,
            new AuthorData($request->validated())
        );

        return new AuthorResource($author);
    }

    public function destroy(Author $author, DeleteAuthorAction $deleteAuthorAction): JsonResponse
    {
        $deleteAuthorAction->execute($author);

        return response()->json();
    }
}
