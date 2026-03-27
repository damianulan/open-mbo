<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TestDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('settings:migrate', ['--no-interaction' => true]);
        $this->call(LanguageSeeder::class);
        Artisan::call('sentinel:run', ['--no-interaction' => true]);
        $this->call(NotificationSeeder::class);
    }
}
