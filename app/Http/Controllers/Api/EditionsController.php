<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Edition;
use App\Http\Resources\EditionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EditionsController
{
    public function show(Edition $edition): JsonResource
    {
        return new EditionResource($edition);
    }
}
