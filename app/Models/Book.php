<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends BaseModel
{
    use SoftDeletes;

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
