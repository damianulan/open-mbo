<?php

namespace App\Enums\Core;

use Enumerable\Laravel\Enum;

class EnvironmentType extends Enum
{
    const LOCAL = 'local';

    const DEVELOPMENT = 'development';

    const TESTING = 'testing';

    const STAGING = 'staging';

    const PRODUCTION = 'production';
}
