<?php

namespace App\Domain\Book\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends BaseModel
{
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
