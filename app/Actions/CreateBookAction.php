<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class CreateBookAction
{
    public function execute(BookData $bookData): Book
    {
        return Book::create($bookData->all());
    }
}
