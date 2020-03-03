<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Card;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboard;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Tool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    protected function gate(): void
    {
        Gate::define('viewNova', static function ($user) {
            return $user->isAdmin();
        });
    }

    /**
     * @return array<Card>
     */
    protected function cards(): array
    {
        return [
            new Help(),
        ];
    }

    /**
     * @return array<Dashboard>
     */
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * @return array<Tool>
     */
    public function tools(): array
    {
        return [];
    }
}
