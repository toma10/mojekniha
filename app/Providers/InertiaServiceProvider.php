<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class InertiaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerInertia();
        $this->registerLengthAwarePaginator();
    }

    protected function registerInertia(): void
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
                        'avatar_url' => $user->avatarUrl(),
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

    protected function registerLengthAwarePaginator(): void
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'links' => $this->links(),
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    $pages = Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    });

                    return [
                        'pages' => $pages,
                        'previous' => [
                            'url' => $this->previousPageUrl(),
                            'label' => __('pagination.previous'),
                            'active' => false,
                        ],
                        'next' => [
                            'url' => $this->nextPageUrl(),
                            'label' => __('pagination.next'),
                            'active' => false,
                        ],
                    ];
                }
            };
        });
    }
}
