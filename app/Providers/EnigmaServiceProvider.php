<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class EnigmaServiceProvider extends ServiceProvider
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
        Blueprint::macro('encryptable', function (string $column, bool $index = false): void {
            $this->text($column)->nullable();
            if ($index) {
                $this->string($column . '_hash', 64)->nullable()->index();
            } else {
                $this->string($column . '_hash', 64)->nullable();
            }
        });
    }
}
