<?php

namespace App\Actions;

use App\Models\Author;
use Illuminate\Http\UploadedFile;

class UploadAuthorPortraitImageAction
{
    public function execute(Author $author, UploadedFile $image): void
    {
        $author
            ->addMedia($image)
            ->usingName($author->name)
            ->usingFileName("{$author->name}.jpg")
            ->sanitizingFileName(static function ($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('portrait-image');
    }
}
