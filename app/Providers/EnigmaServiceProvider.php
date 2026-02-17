<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class EnigmaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blueprint::macro('encryptable', function (string $column, bool $index = false): void {
            $this->text($column)->nullable();
            if($index) {
                $this->string($column . '_hash', 64)->nullable()->index();
            } else {
                $this->string($column . '_hash', 64)->nullable();
            }
        });
    }
}
