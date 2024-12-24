<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenance = config('app.maintenance') === true;
        $user = Auth::user();
        if($maintenance){
            if($user && Auth::check()){
                if(!$user->can('maintenance')){
                    Auth::logout();
                    abort(503);
                }
            }
        }
        return $next($request);
    }
}
