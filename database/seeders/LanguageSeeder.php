<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Arr;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageLine::all()->delete();
        $langs = [
            'alerts' => Arr::dot(__('alerts')),
            'auth' => Arr::dot(__('auth')),
            'buttons' => Arr::dot(__('buttons')),
            'charts' => Arr::dot(__('charts')),
            'exceptions' => Arr::dot(__('exceptions')),
            'mbo' => Arr::dot(__('mbo')),
        ];
        foreach ($langs as $group => $lines) {
            echo "[" . PHP_EOL;
            foreach ($lines as $key => $value) {
                echo "'$key' => [
                        'pl' => '$value',
                    ]," . PHP_EOL;
            }
            echo "];" . PHP_EOL;
        }
    }
}
