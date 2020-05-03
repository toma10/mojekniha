<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Tag;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TagsController
{
    public function show(Tag $tag): JsonResource
    {
        return new TagResource($tag);
    }
}
