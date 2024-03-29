<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends BaseModel implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public const FALLBACK_COVER_IMAGE = 'images/book-cover.jpg';

    /** @var array<string,string> */
    protected $casts = [
        'average_rating' => 'float',
    ];

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

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class)->orderBy('release_year');
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

    public function readingListItems(): HasMany
    {
        return $this->hasMany(ReadingListItem::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope('average_rating', function (Builder $builder): void {
            $builder->withCount([
                'readingListItems as ratings_count',
                'readingListItems as average_rating' => function ($query): void {
                    $query->select(DB::raw('avg(rating)'));
                },
            ]);
        });
    }
}
