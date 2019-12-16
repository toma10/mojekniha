<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Book extends BaseModel implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover-image')
            ->useFallbackUrl(public_path('/images/book-cover.jpg'))
            ->singleFile();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
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
