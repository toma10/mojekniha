<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class NationalityPolicy
{
    use HandlesAuthorization;

    public function view(): bool
    {
        return true;
    }
}
