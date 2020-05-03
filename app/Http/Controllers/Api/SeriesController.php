<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Series;
use App\Http\Resources\SeriesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SeriesController
{
    public function show(Series $series): JsonResource
    {
        return new SeriesResource($series);
    }
}
