<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Edition extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    public const FALLBACK_COVER_IMAGE = 'images/book-cover.jpg';

    /** @var array<string> */
    protected $appends = [
        'cover_url',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover-image')
            ->useFallbackUrl(url(self::FALLBACK_COVER_IMAGE))
            ->singleFile();
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('cover-image');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function bookBinding(): BelongsTo
    {
        return $this->belongsTo(BookBinding::class);
    }
}
