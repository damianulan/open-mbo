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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! $request->user()) {
            return $next($request);
        }

        $language = $request->user()->preferences->lang ?? null;

        $availableLocales = config('app.available_locales');
        if (isset($language) && in_array($language, $availableLocales)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
