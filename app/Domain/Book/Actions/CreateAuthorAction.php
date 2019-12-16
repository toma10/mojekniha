<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\AuthorData;
use App\Domain\Book\Models\Author;

class CreateAuthorAction
{
    /** @var UploadAuthorPortraitImageAction */
    protected $uploadAuthorPortraitImageAction;

    public function __construct(UploadAuthorPortraitImageAction $uploadAuthorPortraitImageAction)
    {
        $this->uploadAuthorPortraitImageAction = $uploadAuthorPortraitImageAction;
    }

    public function execute(AuthorData $authorData): Author
    {
        $author = Author::create(
            $authorData->except('portrait_image')->toArray()
        );

        if ($authorData->portrait_image) {
            $this->uploadAuthorPortraitImageAction->execute($author, $authorData->portrait_image);
        }

        return $author;
    }
}
