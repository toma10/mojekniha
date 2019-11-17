<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends BaseModel
{
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
