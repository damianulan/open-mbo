<?php

namespace Database\Seeders;

use App\Support\Lang\LanguageModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\TranslationLoader\LanguageLine;

class LanguageSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::allFiles(base_path('lang/src'));

        foreach ($files as $file) {
            $group = Str::of($file->getFilename())->before('.')->toString();
            $contents = $file->getContents();
            if ( ! empty($contents)) {
                $contents = json_decode($contents, true);

                $contents = Arr::dot($contents);
                $lines = [];

                foreach ($contents as $key => $value) {
                    $k = Str::beforeLast($key, '.');
                    $l = Str::afterLast($key, '.');
                    $lines[$k][$l] = $value;
                }

                foreach ($lines as $key => $value) {
                    $instance = LanguageModel::where('group', $group)->where('key', $key)->first();
                    if ($instance) {
                        $instance->group = $group;
                        $instance->key = $key;
                        $instance->text = $value;
                        $instance->update();
                    } else {
                        LanguageModel::create([
                            'group' => $group,
                            'key' => $key,
                            'text' => $value
                        ]);
                    }
                }

            }
        }
    }

}
