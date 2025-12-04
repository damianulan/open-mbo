<?php

namespace App\Enums\Core;

use Enumerable\Laravel\Enum;

class ExportType extends Enum
{
    const EXCEL = 'excel';
    const CSV = 'csv';
    const JSON = 'json';
    const PDF = 'pdf';
    const PRINT = 'print';

    public static function labels(): array
    {
        return array(
            self::EXCEL => __('globals.exports.excel'),
            self::CSV => __('globals.exports.csv'),
            self::JSON => __('globals.exports.json'),
            self::PDF => __('globals.exports.pdf'),
            self::PRINT => __('globals.exports.print'),
        );
    }
}
