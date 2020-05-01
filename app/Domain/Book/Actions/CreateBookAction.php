<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Book;

class CreateBookAction
{
    protected UploadBookCoverImageAction $uploadBookCoverImageAction;

    public function __construct(UploadBookCoverImageAction $uploadBookCoverImageAction)
    {
        $this->uploadBookCoverImageAction = $uploadBookCoverImageAction;
    }

    public function execute(BookData $bookData): Book
    {
        $book = Book::create(
            $bookData->except('cover_image', 'genres', 'tags')->toArray()
        );

        if ($bookData->cover_image) {
            $this->uploadBookCoverImageAction->execute($book, $bookData->cover_image);
        }

        if (is_array($bookData->genres)) {
            $book->genres()->sync($bookData->genres);
        }

        if (is_array($bookData->tags)) {
            $book->tags()->sync($bookData->tags);
        }

        return $book;
    }
}
