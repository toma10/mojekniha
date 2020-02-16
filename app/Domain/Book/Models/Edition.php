<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Edition extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover-image')
            ->useFallbackUrl(url('/images/book-cover.jpg'))
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

    public function bookBinding(): BelongsTo
    {
        return $this->belongsTo(BookBinding::class);
    }
}
