<?php

namespace App\Settings\Abstract;

use ReflectionClass;
use ReflectionProperty;
use Spatie\LaravelSettings\Exceptions\MissingSettings;
use Spatie\LaravelSettings\Migrations\SettingsMigrator;
use Spatie\LaravelSettings\Models\SettingsProperty;
use Spatie\LaravelSettings\Settings;

abstract class BaseSettings extends Settings
{
    public static function migrate(): array
    {
        $logs = array();
        $class = static::class;
        $instance = new $class();
        $group = static::group();
        $reflection = new ReflectionClass(static::class);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        if ( ! empty($properties)) {
            $migrator = app(SettingsMigrator::class);

            foreach ($properties as $property) {
                if ($property->hasDefaultValue()) {
                    $prop = $property->getName();

                    $setting = SettingsProperty::where('group', $group)->where('name', $prop)->first();
                    if ($setting) {
                        continue;
                    }
                    $setting = $group . '.' . $prop;
                    $value = $instance->{$prop};
                    $migrator->add($setting, $value);

                    $logs[] = "Setting {$setting} added with default value.";
                }
            }
        }

        return $logs;
    }

    public function save(): self
    {
        try {
            return parent::save();
        } catch (MissingSettings $e) {
            self::migrate();
            return parent::save();
        }

        return $this;
    }
}
