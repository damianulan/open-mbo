<?php

namespace App\Providers;

use App\Models\Core\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user, $context = null) use ($permission) {
                    return $user->hasPermissionTo($permission, $context);
                });
            });
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }
}
