<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageLine::all()->delete();
        $langs = [
            '\Database\Seeders\Lang\Alerts',
            '\Database\Seeders\Lang\Auth',
            '\Database\Seeders\Lang\Buttons',
            '\Database\Seeders\Lang\Charts',
            '\Database\Seeders\Lang\Exceptions',
            '\Database\Seeders\Lang\Fields',
            '\Database\Seeders\Lang\MBO',
            '\Database\Seeders\Lang\Forms',
            '\Database\Seeders\Lang\Gates',
            '\Database\Seeders\Lang\Globals',
            '\Database\Seeders\Lang\Logging',
            '\Database\Seeders\Lang\Menus',
            '\Database\Seeders\Lang\Models',
            '\Database\Seeders\Lang\Notifications',
            '\Database\Seeders\Lang\Pages',
            '\Database\Seeders\Lang\Pagination',
            '\Database\Seeders\Lang\Passwords',
            '\Database\Seeders\Lang\Validation',
        ];
        foreach ($langs as $class) {
            $list = $class::list();
            $reflection = new \ReflectionClass($class);
            $group = Str::lower($reflection->getShortName());
            foreach ($list as $key => $value) {
                $instance = LanguageLine::where('group', $group)->where('key', $key)->first();

                LanguageLine::updateOrCreate([
                    'id' => $instance?->id ?? NULL,
                    'group' => $group,
                    'key' => $key,
                    'text' => $value
                ]);
            }
        }
    }
}
