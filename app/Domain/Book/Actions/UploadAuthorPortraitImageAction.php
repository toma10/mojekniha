<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Author;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadAuthorPortraitImageAction
{
    public function execute(Author $author, UploadedFile $image): void
    {
        $author
            ->addMedia($image)
            ->usingName($author->name)
            ->usingFileName(sprintf('%s.jpg', Str::slug($author->name)))
            ->sanitizingFileName(static function (string $fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('portrait-image');
    }
}
