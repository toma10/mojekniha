<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class UpdateAuthorAction
{
    public function execute(Author $author, AuthorData $authorData): Author
    {
        return tap($author, function ($author) use ($authorData) {
            $author->update($authorData->except('portrait_image')->toArray());

            if ($authorData->portrait_image) {
                $author
                    ->addMedia($authorData->portrait_image)
                    ->usingName($authorData->name)
                    ->usingFileName("{$authorData->name}.jpg")
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('portrait-image');
            }
        });
    }
}
