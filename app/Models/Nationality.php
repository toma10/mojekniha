<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Nationality extends BaseModel
{
    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }
}
