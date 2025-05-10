<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * @param  mixed   $request
     * @param  Closure $next
     * @param  mixed   $permission
     * @param  mixed   $context
     * @return void
     */
    public function handle($request, Closure $next, $permission, $context = null)
    {
        if (!Auth::check() || Auth::user()->cannot($permission, $context)) {
            unauthorized();
        }
        return $next($request);
    }
}
