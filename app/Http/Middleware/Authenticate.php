<?php

namespace App\Http\Middleware;

use App\Models\Core\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        $this->ensureEmailIsVerified($request); // TODO
        $this->ensureForcePasswordChange($request);

        return $next($request);
    }

    protected function getUser(): ?User
    {
        return $this->auth->user();
    }

    protected function isFirstLogin(): bool
    {
        $user = $this->getUser();
        return $user?->sessions->isEmpty() ?? false;
    }

    protected function ensureEmailIsVerified(Request $request): bool
    {
        $user = $this->getUser();
        return true;
    }

    protected function ensureForcePasswordChange(Request $request): void
    {
        $user = $this->getUser();
        $config = (config('users.password_change_firstlogin') && $this->isFirstLogin()) || (config('users.force_password_change_reset') && $user->force_password_change);
        if ($user && $config && ! $user->hasRole('root')) {
            redirect()->route('password.change');
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     */
    protected function redirectTo($request): ?string
    {
        if ( ! $request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
