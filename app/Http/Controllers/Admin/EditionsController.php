<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateEditionAction;
use App\Domain\Book\Actions\DeleteEditionAction;
use App\Domain\Book\Actions\UpdateEditionAction;
use App\Domain\Book\DataTransferObjects\EditionData;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use App\Http\Requests\EditionRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EditionsController
{
    public function index(): Response
    {
        $editions = Edition::with('book', 'language')->paginate();

        return Inertia::render('Editions/Index', compact('editions'));
    }

    public function create(): Response
    {
        $books = Book::all();
        $languages = Language::all();
        $bookBindings = BookBinding::all();

        return Inertia::render('Editions/Create', compact('books', 'languages', 'bookBindings'));
    }

    public function store(EditionRequest $request, CreateEditionAction $createEditionAction): RedirectResponse
    {
        $createEditionAction->execute(
            new EditionData($request->validated())
        );

        flash()->success(trans('messages.edition.created'));

        return redirect()->route('admin.books.editions.index');
    }

    public function show(Edition $edition): Response
    {
        $edition->load('book', 'language', 'bookBinding');

        return Inertia::render('Editions/Show', compact('edition'));
    }

    public function edit(Edition $edition): Response
    {
        $books = Book::all();
        $languages = Language::all();
        $bookBindings = BookBinding::all();

        return Inertia::render('Editions/Edit', compact('edition', 'books', 'languages', 'bookBindings'));
    }

    public function update(
        Edition $edition,
        EditionRequest $request,
        UpdateEditionAction $updateEditionAction
    ): RedirectResponse {
        $updateEditionAction->execute(
            $edition,
            new EditionData($request->validated())
        );

        flash()->success(trans('messages.edition.updated'));

        return redirect()->route('admin.books.editions.edit', $edition);
    }

    public function destroy(Edition $edition, DeleteEditionAction $deleteEditionAction): RedirectResponse
    {
        $deleteEditionAction->execute($edition);

        flash()->success(trans('messages.edition.deleted'));

        return redirect()->route('admin.books.editions.index');
    }
}
