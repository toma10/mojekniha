<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends BaseModel
{
    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
    }
}
