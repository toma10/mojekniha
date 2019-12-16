<?php

namespace App\Http\Controllers;

use App\Domain\Book\Actions\CreateGenreAction;
use App\Domain\Book\Actions\DeleteGenreAction;
use App\Domain\Book\Actions\UpdateGenreAction;
use App\Domain\Book\DataTransferObjects\GenreData;
use App\Domain\Book\Models\Genre;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class GenresController
{
    public function show(Genre $genre): JsonResource
    {
        return new GenreResource($genre);
    }

    public function store(GenreRequest $request, CreateGenreAction $createGenreAction): JsonResponse
    {
        $genre = $createGenreAction->execute(
            new GenreData($request->validated())
        );

        return (new GenreResource($genre))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(GenreRequest $request, Genre $genre, UpdateGenreAction $updateGenreAction): JsonResource
    {
        $genre = $updateGenreAction->execute(
            $genre,
            new GenreData($request->validated())
        );

        return new GenreResource($genre);
    }

    public function destroy(Genre $genre, DeleteGenreAction $deleteGenreAction): JsonResponse
    {
        $deleteGenreAction->execute($genre);

        return response()->json();
    }
}
