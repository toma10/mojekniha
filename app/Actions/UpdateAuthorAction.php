<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class UpdateAuthorAction
{
    public function execute(Author $author, AuthorData $authorData): Author
    {
        return tap($author)->update($authorData->all());
    }
}
