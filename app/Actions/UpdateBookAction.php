<?php

namespace App\Actions;

use App\DataTransferObjects\BookData;
use App\Models\Book;

class UpdateBookAction
{
    /** @var UploadBookCoverImageAction */
    protected $uploadBookCoverImageAction;

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
