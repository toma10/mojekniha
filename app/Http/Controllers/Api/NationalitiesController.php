<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Nationality;
use App\Http\Resources\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalitiesController
{
    public function show(Nationality $nationality): JsonResource
    {
        return new NationalityResource($nationality);
    }
}
