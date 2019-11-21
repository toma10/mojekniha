<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends BaseModel
{
    use SoftDeletes;

    public function getCoverImagePathUrlAttribute(): ?string
    {
        if ($this->cover_image_path === null) {
            return null;
        }

        return Storage::url($this->cover_image_path);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
