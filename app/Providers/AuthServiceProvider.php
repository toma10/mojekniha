<?php

namespace App\Providers;

use App\Domain\Book\Models\Language;
use App\Domain\Book\Models\Nationality;
use App\Policies\LanguagePolicy;
use App\Policies\NationalityPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /** @var array<string> */
    protected $policies = [
        Language::class => LanguagePolicy::class,
        Nationality::class => NationalityPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
