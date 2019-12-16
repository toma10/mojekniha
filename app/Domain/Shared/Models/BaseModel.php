<?php

namespace App\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /** @var array<string> */
    protected $guarded = [];
}
