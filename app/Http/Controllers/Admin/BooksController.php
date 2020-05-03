<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateBookAction;
use App\Domain\Book\Actions\DeleteBookAction;
use App\Domain\Book\Actions\UpdateBookAction;
use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Genre;
use App\Domain\Book\Models\Tag;
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
        $tags = Tag::all();
        $genres = Genre::all();

        return Inertia::render('Books/Create', compact('authors', 'tags', 'genres'));
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
        $book->load('author', 'series', 'editions.language', 'genres', 'tags');

        return Inertia::render('Books/Show', compact('book'));
    }

    public function edit(Book $book): Response
    {
        $book->load('genres', 'tags');

        $authors = Author::with('series')->get();
        $tags = Tag::all();
        $genres = Genre::all();

        return Inertia::render('Books/Edit', compact('book', 'authors', 'tags', 'genres'));
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
