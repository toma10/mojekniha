<?php

namespace App\Actions;

use App\Models\Book;

class DeleteBookAction
{
    public function execute(Book $book): void
    {
        $book->delete();
    }
}
