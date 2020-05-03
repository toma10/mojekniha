<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nationality extends BaseModel
{
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder): void {
            $builder->orderBy('name');
        });
    }

    public function authors(): HasMany
    {
        return $this->hasMany(Author::class)->orderBy('name');
    }
}
