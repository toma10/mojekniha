<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerInertia();
    }

    public function registerInertia(): void
    {
        Inertia::setRootView('admin');

        Inertia::version(fn () => md5_file(public_path('mix-manifest.json')));
    }
}
