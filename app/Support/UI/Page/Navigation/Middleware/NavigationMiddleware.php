<?php

namespace App\Support\UI\Page\Navigation\Middleware;

use App\Support\UI\Page\Navigation\Contracts\NavigationContract;
use App\Support\UI\Page\Navigation\NavigationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NavigationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        app()->instance(NavigationContract::class, new NavigationService());

        return $next($request);
    }
}
