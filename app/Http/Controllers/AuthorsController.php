<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Response;
use App\Actions\CreateAuthorAction;
use App\Actions\DeleteAuthorAction;
use App\Actions\UpdateAuthorAction;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\DataTransferObjects\AuthorData;

class AuthorsController
{
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function store(AuthorRequest $request, CreateAuthorAction $createAuthorAction)
    {
        $author = $createAuthorAction->execute(
            new AuthorData($request->validated())
        );

        return (new AuthorResource($author))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Author $author, AuthorRequest $request, UpdateAuthorAction $updateAuthorAction)
    {
        $author = $updateAuthorAction->execute(
            $author,
            new AuthorData($request->validated())
        );

        return new AuthorResource($author);
    }

    public function destroy(Author $author, DeleteAuthorAction $deleteAuthorAction)
    {
        $deleteAuthorAction->execute($author);

        return response()->json();
    }
}
