<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($request->expectsJson()) {
                return response()->json([], Response::HTTP_FORBIDDEN);
            }

            return redirect('/home');
        }

        return $next($request);
    }
}
