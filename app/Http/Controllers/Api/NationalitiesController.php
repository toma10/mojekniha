<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Models\Nationality;
use App\Http\Resources\NationalityResource;

class NationalitiesController
{
    public function show(Nationality $nationality)
    {
        return new NationalityResource($nationality);
    }
}
