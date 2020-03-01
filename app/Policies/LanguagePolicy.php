<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;

    public function view(): bool
    {
        return true;
    }
}
