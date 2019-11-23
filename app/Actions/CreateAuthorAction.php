<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;

class CreateAuthorAction
{
    public function execute(AuthorData $authorData): Author
    {
        $data = $authorData->except('portrait_image')->toArray();
        $data['portrait_image_path'] = optional($authorData->portrait_image)->store('author-portraits', ['disk' => 'public']);

        return Author::create($data);
    }
}
