<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class CreateAuthorAction
{
    public function execute(AuthorData $authorData): Author
    {
        $data = $authorData->except('portrait_image')->toArray();

        return tap(Author::create($data), function ($author) use ($authorData) {
            if ($authorData->portrait_image) {
                $author
                    ->addMedia($authorData->portrait_image)
                    ->usingName($author->name)
                    ->usingFileName("{$author->name}.jpg")
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('portrait-image');
            }
        });
    }
}
