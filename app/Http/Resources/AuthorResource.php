<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray($request)
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
