<?php

namespace App\Support\Filters\Providers;

use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Factories\FilterFinderFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder as DataTableBuilder;

class FiltersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('filter', function (string|FilterContract $filter) {
            $filter = FilterFinderFactory::make($filter);
            if ($this instanceof Builder) {
                return $filter->getQuery($this);
            }
        });

        // DataTableBuilder::macro
    }
}
