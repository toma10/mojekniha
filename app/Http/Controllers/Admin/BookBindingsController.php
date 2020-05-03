<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateBookBindingAction;
use App\Domain\Book\Actions\DeleteBookBindingAction;
use App\Domain\Book\Actions\UpdateBookBindingAction;
use App\Domain\Book\DataTransferObjects\BookBindingData;
use App\Domain\Book\Models\BookBinding;
use App\Http\Requests\BookBindingRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BookBindingsController
{
    public function index(): Response
    {
        $bookBindings = BookBinding::paginate();

        return Inertia::render('BookBindings/Index', compact('bookBindings'));
    }

    public function create(): Response
    {
        return Inertia::render('BookBindings/Create');
    }

    public function store(
        BookBindingRequest $request,
        CreateBookBindingAction $createBookBindingAction
    ): RedirectResponse {
        $createBookBindingAction->execute(
            new BookBindingData($request->validated())
        );

        flash()->success(trans('messages.bookBinding.created'));

        return redirect()->route('admin.books.bookBindings.index');
    }

    public function show(BookBinding $bookBinding): Response
    {
        $bookBinding->load('editions.book', 'editions.language');

        return Inertia::render('BookBindings/Show', compact('bookBinding'));
    }

    public function edit(BookBinding $bookBinding): Response
    {
        return Inertia::render('BookBindings/Edit', compact('bookBinding'));
    }

    public function update(
        BookBinding $bookBinding,
        BookBindingRequest $request,
        UpdateBookBindingAction $updateBookBindingAction
    ): RedirectResponse {
        $updateBookBindingAction->execute(
            $bookBinding,
            new BookBindingData($request->validated())
        );

        flash()->success(trans('messages.bookBinding.updated'));

        return redirect()->route('admin.books.bookBindings.edit', $bookBinding);
    }

    public function destroy(
        BookBinding $bookBinding,
        DeleteBookBindingAction $deleteBookBindingAction
    ): RedirectResponse {
        $deleteBookBindingAction->execute($bookBinding);

        flash()->success(trans('messages.bookBinding.deleted'));

        return redirect()->route('admin.books.bookBindings.index');
    }
}
