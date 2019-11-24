<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends BaseModel implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('portrait-image')
            ->useFallbackUrl(public_path('/images/portrait-image.jpg'))
            ->singleFile();
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
