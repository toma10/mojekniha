<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Access\AuthorizationException;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, callable $next)
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
