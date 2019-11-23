<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends BaseModel
{
    use SoftDeletes;

    public function getPortraitImagePathUrlAttribute(): ?string
    {
        if ($this->portrait_image_path === null) {
            return null;
        }

        return Storage::url($this->portrait_image_path);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function series(): HasMany
    {
        return $this->hasMany(Series::class);
    }
}
