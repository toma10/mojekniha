<?php

namespace App\Http\Resources;

use App\Domain\Shared\Support\HtmlFormatter;
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
            'birth_date' => $this->birth_date->format('Y-m-d'),
            'death_date' => optional($this->death_date)->format('Y-m-d'),
            'biography' => $this->biography,
            'formatted_biography' => HtmlFormatter::format($this->biography),
            'nationality' => new NationalityResource($this->nationality),
            'books' => BookResource::collection($this->whenLoaded('books')),
            'series' => SeriesResource::collection($this->whenLoaded('series')),
            'portrait_url' => $this->portrait_url,
        ];
    }
}
