<?php

namespace App\Actions;

use App\Models\Edition;
use Illuminate\Http\UploadedFile;

class UploadEditionCoverImageAction
{
    public function execute(Edition $edition, UploadedFile $image): void
    {
        $edition
            ->addMedia($image)
            ->usingName($edition->isbn)
            ->usingFileName("{$edition->isbn}.jpg")
            ->sanitizingFileName(function ($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection('cover-image');
    }
}
