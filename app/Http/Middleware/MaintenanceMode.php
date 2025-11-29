<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenance = true === config('app.maintenance');
        $user = Auth::user();
        if ($maintenance) {
            if ($user && Auth::check()) {
                if ( ! $user->can('maintenance')) {
                    Auth::logout();
                    abort(503);
                }
            }
        }

        return $next($request);
    }
}
