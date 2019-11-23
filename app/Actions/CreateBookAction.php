<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class CreateBookAction
{
    public function execute(BookData $bookData): Book
    {
        $data = $bookData->except('cover_image')->toArray();

        return tap(Book::create($data), function ($book) use ($bookData) {
            if ($bookData->cover_image) {
                $book
                    ->addMedia($bookData->cover_image)
                    ->usingName($book->original_name)
                    ->usingFileName("{$book->original_name}.jpg")
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('cover-image');
            }
        });
    }
}
