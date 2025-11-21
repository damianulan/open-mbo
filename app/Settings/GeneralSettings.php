<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class GeneralSettings extends BaseSettings
{
    public string $site_name;

    public ?string $site_logo;

    public string $theme;

    public bool $debug;

    public bool $debugbar;

    public bool $maintenance;

    public string $locale;

    public string $timezone;

    public int $build;

    public string $release;

    public string $target_release;

    public string $date_format;

    public string $time_format;

    public static function group(): string
    {
        return 'general';
    }
}
