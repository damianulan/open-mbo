<?php

namespace App\Providers;

use App\Contracts\MBO\HasWeight;
use App\Settings\MBOSettings;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        EloquentCollection::macro('getTotalWeight', function (): float {
            $weight = 0;
            $this->each(function (Model $model) use (&$weight): void {
                if ($model instanceof HasWeight) {
                    $weight += $model->getWeightAttribute();
                }
            });

            return $weight;
        });

        EloquentCollection::macro('delete', function (): void {
            $this->each(function (Model $model): void {
                $model->delete();
            });
        });

        EloquentCollection::macro('purge', function (): void {
            $this->each(function (Model $model): void {
                $model->forceDelete();
            });
        });
    }
}
