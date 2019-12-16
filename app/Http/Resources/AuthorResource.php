<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Domain\Book\Models\Author
 */
class AuthorResource extends JsonResource
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
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'biography' => $this->biography,
            'nationality' => new NationalityResource($this->nationality),
            'portrait_image_path' => $this->getFirstMediaUrl('portrait-image'),
        ];
    }
}
