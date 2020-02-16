<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Book;

class UpdateBookAction
{
    protected UploadBookCoverImageAction $uploadBookCoverImageAction;

    public function __construct(UploadBookCoverImageAction $uploadBookCoverImageAction)
    {
        $this->uploadBookCoverImageAction = $uploadBookCoverImageAction;
    }

    public function execute(Book $book, BookData $bookData): Book
    {
        $book->update(
            $bookData->except('cover_image')->toArray()
        );

        if ($bookData->cover_image) {
            $this->uploadBookCoverImageAction->execute($book, $bookData->cover_image);
        }

        return $book;
    }
}
