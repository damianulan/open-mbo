<?php

namespace Database\Seeders;

use App\Support\Lang\LanguageModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::allFiles(base_path('lang/src'));

        foreach ($files as $file) {
            $group = Str::of($file->getFilename())->before('.')->toString();
            $contents = $file->getContents();
            if (empty($contents)) {
                continue;
            }

            try {
                $decoded = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            } catch (Throwable) {
                continue;
            }

            $lines = [];
            foreach (Arr::dot($decoded) as $key => $value) {
                $lineKey = Str::beforeLast($key, '.');
                $locale = Str::afterLast($key, '.');

                $lines[$lineKey][$locale] = $value;
            }

            foreach ($lines as $key => $value) {
                LanguageModel::query()->updateOrCreate(
                    [
                        'group' => $group,
                        'key' => $key,
                    ],
                    [
                        'text' => $value,
                    ],
                );
            }
        }
    }
}
