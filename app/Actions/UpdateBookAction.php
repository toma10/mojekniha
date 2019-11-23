<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;

class UpdateBookAction
{
    public function execute(Book $book, BookData $bookData): Book
    {
        return tap($book, function ($book) use ($bookData) {
            $book->update($bookData->except('cover_image')->toArray());

            if ($bookData->cover_image) {
                $book
                    ->addMedia($bookData->cover_image)
                    ->usingName($bookData->original_name)
                    ->usingFileName("{$bookData->original_name}.jpg")
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('cover-image');
            }
        });
    }
}
