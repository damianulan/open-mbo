<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Facades\Modules\ModuleManager;

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
            unauthorized('Moduł, który próbujesz otworzyć został zablokowany przez administratora systemu.');
        }

        return $next($request);
    }
}
