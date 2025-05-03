<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class RouteGate
{

    private static $fallbacks = [
        'settings.general' => [
            'settings.server.index',
            'settings.logs.index',
        ],
        'settings.server' => [
            'settings.general.index',
            'settings.logs.index',
        ],
        'settings.logs' => [
            'settings.general.index',
            'settings.server.index',
        ],
    ];

    /**
     * @param  mixed   $request
     * @param  Closure $next
     * @param  mixed   $permission
     * @param  mixed   $context
     * @return void
     */
    public function handle($request, Closure $next, $permission, $context = null): Response
    {
        if (Auth::user()->cannot($permission, $context)) {
            $currentName = Route::currentRouteName();
            $current = Route::current();
            $all = Route::getRoutes();

            $parent = Str::of($currentName)->beforeLast('.')->toString();
            if (isset(self::$fallbacks[$parent])) {
                $fallbacks = self::$fallbacks[$parent];
                foreach ($fallbacks as $fallback) {
                    try {
                        $fallbackRoute = $all->getByName($fallback);
                        $middlewares = $fallbackRoute->gatherMiddleware();
                        $permission = null;
                        foreach ($middlewares as $middleware) {
                            if (strpos($middleware, 'route.gate') !== false) {
                                $permission = Str::of($middleware)->after('route.gate:')->toString();
                            }
                        }

                        if ($permission) {
                            if (Auth::user()->cannot($permission)) {
                                continue;
                            }
                        }
                        return redirect()->to($fallbackRoute->uri());
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            return unauthorized();
        }
        return $next($request);
    }
}
