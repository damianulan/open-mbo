<?php

namespace Modules\Skeleton;

use Illuminate\Support\ServiceProvider;

/**
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2026 damianulan
 * @license MIT
 */
class SkeletonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modularis.php', 'modularis');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/modularis.php' => config_path('modularis.php'),
        ], 'modularis-config');

        $this->publishes([
            __DIR__ . '/../config/lucent.php' => config_path('modularis.php'),
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
