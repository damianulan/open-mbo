<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if(auth()->user()->cannot($permission, $context)) {
            return abort(403);
        }
        return $next($request);
    }
}
