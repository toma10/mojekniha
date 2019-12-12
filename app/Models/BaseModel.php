<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /** @var array<string> */
    protected $guarded = [];
}
