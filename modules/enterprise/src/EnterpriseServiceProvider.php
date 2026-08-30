<?php

namespace Modules\Enterprise;

use Illuminate\Support\ServiceProvider;

/**
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2026 damianulan
 * @license MIT
 */
class EnterpriseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/enterprise.php', 'enterprise');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/enterprise.php' => config_path('enterprise.php'),
        ], 'modularis-config');

        $this->publishes([
            __DIR__ . '/../config/enterprise.php' => config_path('enterprise.php'),
        ], 'modularis');

        $this->registerCommands();
    }

    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            //
        }
    }
}
