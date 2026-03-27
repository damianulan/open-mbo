<?php

namespace App\Providers;

use App\Console\Commands\Core\LangList;
use App\Support\Storage\StorageManager;
use App\Support\UI\Theme\Theme;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ( ! $this->app->environment('production')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        if ($this->app->environment('local')) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton(Theme::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('Debugbar', Debugbar::class);
        $this->app->singleton(StorageManager::class);

        $this->optimizes(
            clear: LangList::class,
            key: 'langs-cache',
        );
        // Health::checks([
        //     UsedDiskSpaceCheck::new()->dailyAt('02:00'),
        //     DatabaseCheck::new()->dailyAt('02:00'),
        //     DatabaseSizeCheck::new()->failWhenSizeAboveGb(errorThresholdGb: 5.0)->dailyAt('02:00'),
        //     RedisCheck::new()->dailyAt('02:00'),
        //     DebugModeCheck::new()->dailyAt('02:00'),
        //     ScheduleCheck::new()->dailyAt('02:00'),

        // ]);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);
        Paginator::useBootstrapFive();
    }
}
