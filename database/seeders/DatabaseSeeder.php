<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('settings:migrate', ['--no-interaction' => true]);
        $this->call([
            LanguageSeeder::class,
            NotificationSeeder::class,
        ]);
        Artisan::call('sentinel:run', ['--no-interaction' => true]);
        $this->call([
            CreateAdminUserSeeder::class,
            BusinessSeeder::class,
            UserSeeder::class,
            MBOSeeder::class,
        ]);
    }
}
