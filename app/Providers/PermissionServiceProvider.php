<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Core\Permission;
use App\Enums\Core\PermissionLib;

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
