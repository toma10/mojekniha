<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Edition extends BaseModel
{
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
