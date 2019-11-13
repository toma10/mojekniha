<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends BaseModel
{
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
