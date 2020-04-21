<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);

        $this->setupFlashMessageLevels();
    }

    protected function setupFlashMessageLevels(): void
    {
        Flash::levels([
            'success' => 'bg-green-100 border border-green-400 text-green-700',
            'warning' => 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            'error' => 'bg-red-100 border border-red-400 text-red-700',
        ]);
    }
}
