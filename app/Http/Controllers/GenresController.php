<?php

namespace App\Http\Controllers;

use App\Actions\CreateGenreAction;
use App\Actions\DeleteGenreAction;
use App\Actions\UpdateGenreAction;
use App\DataTransferObjects\GenreData;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
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
