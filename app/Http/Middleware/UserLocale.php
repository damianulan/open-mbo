<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(! $request->user()) {
            return $next($request);
        }

        $language = $request->user()->profile->lang ?? null;

        $availableLocales = config('app.available_locales');
        if (isset($language) && in_array($language, $availableLocales)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
