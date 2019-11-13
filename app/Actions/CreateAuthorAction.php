<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class CreateAuthorAction
{
    public function execute(AuthorData $authorData): Author
    {
        return Author::create($authorData->all());
    }
}
