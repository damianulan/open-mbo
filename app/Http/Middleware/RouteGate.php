<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RouteGate
{
    private static $fallbacks = array(
        'settings.general' => array(
            'settings.server.index',
            'settings.logs.index',
        ),
        'settings.server' => array(
            'settings.general.index',
            'settings.logs.index',
        ),
        'settings.logs' => array(
            'settings.general.index',
            'settings.server.index',
        ),
    );

    /**
     * @param  mixed  $request
     * @param  mixed  $permission
     * @param  mixed  $context
     * @param Closure $next
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
                            if (str_contains($middleware, 'route.gate')) {
                                $permission = Str::of($middleware)->after('route.gate:')->toString();
                            }
                        }

                        if ($permission) {
                            if (Auth::user()->cannot($permission)) {
                                continue;
                            }
                        }

                        return redirect()->to($fallbackRoute->uri());
                    } catch (Exception $e) {
                        continue;
                    }
                }
            }

            return unauthorized();
        }

        return $next($request);
    }
}
