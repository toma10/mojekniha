<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Response;
use App\Actions\CreateGenreAction;
use App\Actions\DeleteGenreAction;
use App\Actions\UpdateGenreAction;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\DataTransferObjects\GenreData;

class GenresController
{
    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    public function store(GenreRequest $request, CreateGenreAction $createGenreAction)
    {
        $genre = $createGenreAction->execute(
            new GenreData($request->validated())
        );

        return (new GenreResource($genre))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(GenreRequest $request, Genre $genre, UpdateGenreAction $updateGenreAction)
    {
        $genre = $updateGenreAction->execute(
            $genre,
            new GenreData($request->validated())
        );

        return new GenreResource($genre);
    }

    public function destroy(Genre $genre, DeleteGenreAction $deleteGenreAction)
    {
        $deleteGenreAction->execute($genre);

        return response()->json();
    }
}
