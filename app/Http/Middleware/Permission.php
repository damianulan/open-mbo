<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $context = null)
    {
        if(!auth()->user()->can($permission, $context)) {
            return abort(403);
        }
        return $next($request);
    }
}
