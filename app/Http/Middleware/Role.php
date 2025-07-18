<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! Auth::check() || ! Auth::user()->hasRole($role)) {
            return unauthorized();
        }

        return $next($request);
    }
}
