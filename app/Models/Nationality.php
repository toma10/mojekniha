<?php

namespace App\Models;

class Nationality extends BaseModel
{
    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
