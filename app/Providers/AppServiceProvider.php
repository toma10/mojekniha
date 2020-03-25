<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootInertia();
    }

    public function bootInertia(): void
    {
        Inertia::setRootView('admin');

        Inertia::version(static fn () => md5_file(public_path('mix-manifest.json')));

        Inertia::share([
            'auth' => static function () {
                $user = Auth::guard('web')->user();

                return [
                    'user' => $user ? [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'username' => $user->username,
                    ] : null,
                ];
            },
            'errors' => static fn () => Session::get('errors')
                ? Session::get('errors')->getBag('default')->getMessages()
                : (object) [],
        ]);
    }
}
