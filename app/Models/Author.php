<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends BaseModel
{
    use SoftDeletes;

    public function nationality()
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
