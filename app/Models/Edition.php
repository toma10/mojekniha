<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Edition extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover-image')
            ->useFallbackUrl(public_path('/images/book-cover.jpg'))
            ->singleFile();
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
