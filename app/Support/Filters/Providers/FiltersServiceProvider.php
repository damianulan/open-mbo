<?php

namespace App\Support\Filters\Providers;

use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Factories\FilterFinderFactory;
use App\Support\Filters\Services\FilterService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class FiltersServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Builder::macro('filter', function (string|FilterContract $filter) {
            $filter = FilterFinderFactory::make($filter);
            if ($this instanceof Builder) {
                return $filter->getQuery($this);
            }
        });

        Builder::macro('registerFilters', function (array|FilterService $service) {
            if (is_array($service)) {
                $service = new FilterService($service);
            }
            foreach ($service->getItems() as $filter) {
                $this->filter($filter);
            }

            return $this;
        });
    }
}
