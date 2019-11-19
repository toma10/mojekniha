<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Series extends BaseModel
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
