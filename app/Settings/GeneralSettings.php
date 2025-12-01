<?php

namespace App\Settings;

use App\Enums\Core\ExportType;
use App\Settings\Abstract\BaseSettings;

class GeneralSettings extends BaseSettings
{
    public string $site_name = 'OpenMBO';

    public ?string $site_logo = null;

    public string $theme = 'default';

    public bool $debug = true;

    public bool $debugbar = true;

    public bool $maintenance = false;

    public string $locale = 'pl';

    public string $timezone = 'Europe/Warsaw';

    public int $build = 0;

    public string $release = 'dev';

    public string $target_release = 'dev';

    public string $date_format = 'd.m.Y';

    public string $time_format = 'H:i';

    public array $export_types = [ExportType::EXCEL, ExportType::CSV, ExportType::JSON, ExportType::PDF, ExportType::PRINT];

    public static function group(): string
    {
        return 'general';
    }
}
