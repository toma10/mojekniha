<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class UpdateBookAction
{
    public function execute(Book $book, BookData $bookData): Book
    {
        return tap($book)->update($bookData->all());
    }
}
