<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class CreateAuthorAction
{
    protected $uploadAuthorPortraitImageAction;

    public function __construct(UploadAuthorPortraitImageAction $uploadAuthorPortraitImageAction)
    {
        $this->uploadAuthorPortraitImageAction = $uploadAuthorPortraitImageAction;
    }

    public function execute(AuthorData $authorData): Author
    {
        $author =Author::create(
            $authorData->except('portrait_image')->toArray()
        );

        if ($authorData->portrait_image) {
            $this->uploadAuthorPortraitImageAction->execute($author, $authorData->portrait_image);
        }

        return $author;
    }
}
