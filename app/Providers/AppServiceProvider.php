<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

use App\Models\Core\User;
use App\Models\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy(User::class, UserPolicy::class);

    }
}
