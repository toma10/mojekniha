<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateGenreAction;
use App\Domain\Book\Actions\DeleteGenreAction;
use App\Domain\Book\Actions\UpdateGenreAction;
use App\Domain\Book\DataTransferObjects\GenreData;
use App\Domain\Book\Models\Genre;
use App\Http\Requests\GenreRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class GenresController
{
    public function index(): Response
    {
        $genres = Genre::paginate();

        return Inertia::render('Genres/Index', compact('genres'));
    }

    public function create(): Response
    {
        return Inertia::render('Genres/Create');
    }

    public function store(GenreRequest $request, CreateGenreAction $createGenreAction): RedirectResponse
    {
        $createGenreAction->execute(
            new GenreData($request->validated())
        );

        flash()->success(trans('messages.genre.created'));

        return redirect()->route('admin.books.genres.index');
    }

    public function show(Genre $genre): Response
    {
        $genre->load('books.author');

        return Inertia::render('Genres/Show', compact('genre'));
    }

    public function edit(Genre $genre): Response
    {
        return Inertia::render('Genres/Edit', compact('genre'));
    }

    public function update(Genre $genre, GenreRequest $request, UpdateGenreAction $updateGenreAction): RedirectResponse
    {
        $updateGenreAction->execute(
            $genre,
            new GenreData($request->validated())
        );

        flash()->success(trans('messages.genre.updated'));

        return redirect()->route('admin.books.genres.edit', $genre);
    }

    public function destroy(Genre $genre, DeleteGenreAction $deleteGenreAction): RedirectResponse
    {
        $deleteGenreAction->execute($genre);

        flash()->success(trans('messages.genre.deleted'));

        return redirect()->route('admin.books.genres.index');
    }
}
