<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Series extends BaseModel
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class)->orderBy('release_year');
    }
}
