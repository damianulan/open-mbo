<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Support\Modules\ModuleManager;

class ModulesEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $verified = ModuleManager::check($module);
        if (!$verified) {
            unauthorized(__('alerts.system.unauthorized_module'));
        }

        return $next($request);
    }
}
