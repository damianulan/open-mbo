<?php

namespace App\Http\Middleware;

use App\Support\Modules\ModuleManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModulesEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * @param Request $request
     * @param string $module
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $verified = ModuleManager::check($module);
        if ( ! $verified) {
            unauthorized(__('alerts.system.unauthorized_module'));
        }

        return $next($request);
    }
}
