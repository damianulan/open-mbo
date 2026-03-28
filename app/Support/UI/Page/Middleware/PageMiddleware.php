<?php

namespace App\Support\UI\Page\Middleware;

use App\Support\UI\Page\PageBuilder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        app()->instance('page', new PageBuilder);

        return $next($request);
    }
}
