<?php

namespace App\Enums\Core;

use Lucent\Support\Enum;

class ExportType extends Enum
{
    const EXCEL = 'excel';
    const CSV = 'csv';
    const JSON = 'json';
    const PDF = 'pdf';
    const PRINT = 'print';
}
