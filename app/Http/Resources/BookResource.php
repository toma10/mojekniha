<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Domain\Book\Models\Book
 */
class BookResource extends JsonResource
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
            'original_name' => $this->original_name,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'cover_url' => $this->cover_url,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'series' => new SeriesResource($this->whenLoaded('series')),
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
