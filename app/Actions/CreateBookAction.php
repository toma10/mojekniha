<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class CreateBookAction
{
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
