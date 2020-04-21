<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class EnsureUserIsAdmin
{
    public function handle($request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            if ($request->expectsJson()) {
                throw new AuthorizationException();
            }

            return redirect()->route('admin.auth.login');
        }

        return $next($request);
    }
}
