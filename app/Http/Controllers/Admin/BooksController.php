<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateBookAction;
use App\Domain\Book\Actions\DeleteBookAction;
use App\Domain\Book\Actions\UpdateBookAction;
use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BooksController
{
    public function index(): Response
    {
        $books = Book::with('author')->paginate();

        return Inertia::render('Books/Index', compact('books'));
    }

    public function create(): Response
    {
        $authors = Author::with('series')->get();

        return Inertia::render('Books/Create', compact('authors'));
    }

    public function store(BookRequest $request, CreateBookAction $createBookAction): RedirectResponse
    {
        $createBookAction->execute(
            new BookData($request->validated())
        );

        flash()->success(trans('messages.book.created'));

        return redirect()->route('admin.books.books.index');
    }

    public function show(Book $book): Response
    {
        $book->load('author', 'series');

        return Inertia::render('Books/Show', compact('book'));
    }

    public function edit(Book $book): Response
    {
        $authors = Author::with('series')->get();

        return Inertia::render('Books/Edit', compact('book', 'authors'));
    }

    public function update(Book $book, BookRequest $request, UpdateBookAction $updateBookAction): RedirectResponse
    {
        $updateBookAction->execute(
            $book,
            new BookData($request->validated())
        );

        flash()->success(trans('messages.book.updated'));

        return redirect()->route('admin.books.books.edit', $book);
    }

    public function destroy(Book $book, DeleteBookAction $deleteBookAction): RedirectResponse
    {
        $deleteBookAction->execute($book);

        flash()->success(trans('messages.book.deleted'));

        return redirect()->route('admin.books.books.index');
    }
}
