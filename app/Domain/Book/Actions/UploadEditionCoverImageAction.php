<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Edition;
use Illuminate\Http\UploadedFile;

class UploadEditionCoverImageAction
{
    public function execute(Edition $edition, UploadedFile $image): void
    {
        $edition
            ->addMedia($image)
            ->usingName($edition->isbn)
            ->usingFileName("{$edition->isbn}.jpg")
            ->sanitizingFileName(static function (string $fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('cover-image');
    }
}
