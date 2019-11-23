<?php

namespace App\Actions;

use App\Models\Author;
use App\DataTransferObjects\AuthorData;
use Illuminate\Support\Facades\Storage;

class UpdateAuthorAction
{
    public function execute(Author $author, AuthorData $authorData): Author
    {
        $data = $authorData->except('portrait_image')->toArray();

        if ($authorData->portrait_image) {
            Storage::disk('public')->delete($author->portrait_image_path);
            $data['portrait_image_path'] = $authorData->portrait_image->store('author-portraits', ['disk' => 'public']);
        }

        return tap($author)->update($data);
    }
}
