<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Author extends BaseModel implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public const FALLBACK_PORTRAIT_IMAGE = 'images/portrait-image.jpg';

    /** @var array<string> */
    protected $dates = [
        'birth_date',
        'death_date',
    ];

    /** @var array<string> */
    protected $appends = [
        'portrait_url',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('portrait-image')
            ->useFallbackUrl(url(self::FALLBACK_PORTRAIT_IMAGE))
            ->singleFile();
    }

    public function getPortraitUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('portrait-image');
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class)->orderBy('release_year');
    }

    public function series(): HasMany
    {
        return $this->hasMany(Series::class)->orderBy('name');
    }
}
