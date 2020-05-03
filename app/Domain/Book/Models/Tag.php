<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->orderBy('name');
    }
}
