<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class CreateBookAction
{
    public function execute(BookData $bookData): Book
    {
        $data = $bookData->except('cover_image')->toArray();
        $data['cover_image_path'] = optional($bookData->cover_image)->store('book-covers', ['disk' => 'public']);

        return Book::create($data);
    }
}
