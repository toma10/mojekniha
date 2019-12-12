<?php

namespace App\Actions;

use App\DataTransferObjects\BookData;
use App\Models\Book;

class CreateBookAction
{
    /** @var UploadBookCoverImageAction */
    protected $uploadBookCoverImageAction;

    public function __construct(UploadBookCoverImageAction $uploadBookCoverImageAction)
    {
        $this->uploadBookCoverImageAction = $uploadBookCoverImageAction;
    }

    public function execute(BookData $bookData): Book
    {
        $book = Book::create(
            $bookData->except('cover_image')->toArray()
        );

        if ($bookData->cover_image) {
            $this->uploadBookCoverImageAction->execute($book, $bookData->cover_image);
        }

        return $book;
    }
}
