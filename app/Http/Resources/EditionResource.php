<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Domain\Book\Models\Edition
 */
class EditionResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array<mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'release_year' => $this->release_year,
            'language' => new LanguageResource($this->language),
            'number_of_pages' => $this->number_of_pages,
            'number_of_copies' => $this->number_of_copies,
            'book_binding' => new BookBindingResource($this->bookBinding),
            'cover_image_path' => $this->getFirstMediaUrl('cover-image'),
        ];
    }
}
