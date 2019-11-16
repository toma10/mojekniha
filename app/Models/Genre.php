<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends BaseModel
{
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
