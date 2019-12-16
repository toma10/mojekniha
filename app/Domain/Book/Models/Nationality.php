<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nationality extends BaseModel
{
    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }
}
