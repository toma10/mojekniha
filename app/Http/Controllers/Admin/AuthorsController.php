<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateAuthorAction;
use App\Domain\Book\Actions\DeleteAuthorAction;
use App\Domain\Book\Actions\UpdateAuthorAction;
use App\Domain\Book\DataTransferObjects\AuthorData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AuthorsController
{
    public function index(): Response
    {
        $authors = Author::with('nationality')->paginate();

        return Inertia::render('Authors/Index', compact('authors'));
    }

    public function create(): Response
    {
        $nationalities = Nationality::all();

        return Inertia::render('Authors/Create', compact('nationalities'));
    }

    public function store(AuthorRequest $request, CreateAuthorAction $createAuthorAction): RedirectResponse
    {
        $createAuthorAction->execute(
            new AuthorData($request->validated())
        );

        flash()->success(trans('messages.author.created'));

        return redirect()->route('admin.books.authors.index');
    }

    public function show(Author $author): Response
    {
        $author->load('nationality', 'books', 'series');

        return Inertia::render('Authors/Show', compact('author'));
    }

    public function edit(Author $author): Response
    {
        $nationalities = Nationality::all();

        return Inertia::render('Authors/Edit', compact('author', 'nationalities'));
    }

    public function update(
        Author $author,
        AuthorRequest $request,
        UpdateAuthorAction $updateAuthorAction
    ): RedirectResponse {
        $updateAuthorAction->execute(
            $author,
            new AuthorData($request->validated())
        );

        flash()->success(trans('messages.author.updated'));

        return redirect()->route('admin.books.authors.edit', $author);
    }

    public function destroy(Author $author, DeleteAuthorAction $deleteAuthorAction): RedirectResponse
    {
        $deleteAuthorAction->execute($author);

        flash()->success(trans('messages.author.deleted'));

        return redirect()->route('admin.books.authors.index');
    }
}
