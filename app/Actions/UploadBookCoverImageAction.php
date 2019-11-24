<?php

namespace App\Actions;

use App\Models\Book;
use Illuminate\Http\UploadedFile;

class UploadBookCoverImageAction
{
    public function execute(Book $book, UploadedFile $image): void
    {
        $book
            ->addMedia($image)
            ->usingName($book->original_name)
            ->usingFileName("{$book->original_name}.jpg")
            ->sanitizingFileName(function ($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('cover-image');
    }
}
