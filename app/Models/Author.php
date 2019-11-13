<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends BaseModel
{
    use SoftDeletes;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
