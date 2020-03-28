<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Spatie\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->setupFlashMessage();

        $this->bootInertia();
    }

    protected function setupFlashMessage(): void
    {
        Flash::levels([
            'success' => 'bg-green-100 border border-green-400 text-green-700',
            'warning' => 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            'error' => 'bg-red-100 border border-red-400 text-red-700',
        ]);
    }

    protected function bootInertia(): void
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
            'flash' => static fn () => flash()->message ? [
                'message' => flash()->message,
                'level' => flash()->level,
                'class' => flash()->class,
            ] : null,
            'errors' => static fn () => Session::get('errors')
                ? Session::get('errors')->getBag('default')->getMessages()
                : (object) [],
        ]);
    }
}
