<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use ReflectionClass;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Arr;

class LanguageSeeder extends Seeder
{

    /**
     * Parts of lang locations is enough
     *
     * @var array
     */
    private $editables = [
        'alerts.%',
        'auth.failed',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = File::allFiles(base_path('lang/src'));

        foreach ($files as $file) {
            $group = Str::of($file->getFilename())->before('.')->toString();
            $contents = $file->getContents();
            if(!empty($contents)) {
                $contents = json_decode($contents, true);

                $contents = Arr::dot($contents);
                $lines = [];

                foreach($contents as $key => $value) {
                    $k = Str::beforeLast($key, '.');
                    $l = Str::afterLast($key, '.');
                    $lines[$k][$l] = $value;
                }

                foreach ($lines as $key => $value) {
                    $instance = LanguageLine::where('group', $group)->where('key', $key)->first();
                    $editable = $this->isEditable($group, $key);

                    if ($instance) {
                        $instance->group = $group;
                        $instance->key = $key;
                        $instance->text = $value;
                        $instance->editable = $editable;
                        $instance->update();
                    } else {
                        LanguageLine::create(array(
                            'group' => $group,
                            'key' => $key,
                            'text' => $value,
                            'editable' => $editable,
                        ));
                    }
                }

            }
        }
    }

    private function isEditable(string $group, string $key): bool
    {
        $output = false;
        $str = $group.'.'.$key;

        if(Str::contains($str, $this->editables)) {
            $output = true;
        }

        return $output;
    }
}
