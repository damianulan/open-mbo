<?php

namespace App\Enums\Core;

use App\Support\Concerns\EnumHasValues;

enum EnvironmentType: string
{
    use EnumHasValues;

    case LOCAL = 'local';

    case DEVELOPMENT = 'development';

    case TESTING = 'testing';

    case STAGING = 'staging';

    case PRODUCTION = 'production';
}
