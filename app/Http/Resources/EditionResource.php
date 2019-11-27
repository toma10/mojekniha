<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'release_year' => $this->release_year,
            'language' => new LanguageResource($this->language),
            'number_of_pages' => $this->number_of_pages,
            'number_of_copies' => $this->number_of_copies,
            'cover_image_path' => $this->getFirstMediaUrl('cover-image'),
        ];
    }
}
