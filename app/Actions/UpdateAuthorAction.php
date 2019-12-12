<?php

namespace App\Actions;

use App\DataTransferObjects\AuthorData;
use App\Models\Author;

class UpdateAuthorAction
{
    /** @var UploadAuthorPortraitImageAction */
    protected $uploadAuthorPortraitImageAction;

    public function __construct(UploadAuthorPortraitImageAction $uploadAuthorPortraitImageAction)
    {
        $this->uploadAuthorPortraitImageAction = $uploadAuthorPortraitImageAction;
    }

    public function execute(Author $author, AuthorData $authorData): Author
    {
        $author->update($authorData->except('portrait_image')->toArray());

        if ($authorData->portrait_image) {
            $this->uploadAuthorPortraitImageAction->execute($author, $authorData->portrait_image);
        }

        return $author;
    }
}
