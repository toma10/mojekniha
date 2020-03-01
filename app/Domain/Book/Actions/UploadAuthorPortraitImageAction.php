<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Author;
use Illuminate\Http\UploadedFile;

class UploadAuthorPortraitImageAction
{
    public function execute(Author $author, UploadedFile $image): void
    {
        $author
            ->addMedia($image)
            ->usingName($author->name)
            ->usingFileName("{$author->name}.jpg")
            ->sanitizingFileName(static function (string $fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('portrait-image');
    }
}
