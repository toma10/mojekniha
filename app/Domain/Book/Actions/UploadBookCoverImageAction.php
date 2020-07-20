<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadBookCoverImageAction
{
    public function execute(Book $book, UploadedFile $image): void
    {
        $book
            ->addMedia($image)
            ->usingName($book->original_name)
            ->usingFileName(sprintf('%s.jpg', Str::slug($book->original_name)))
            ->sanitizingFileName(static function (string $fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('cover-image');
    }
}
