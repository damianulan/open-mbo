<?php

namespace App\Enums\MBO;

use FormForge\Enums\Enum;

class UserObjectiveStatus extends Enum
{
    const UNSTARTED = 'unstarted';
    const PROGRESS = 'progress';
    const COMPLETED = 'completed';
    const PASSED = 'passed';
    const FAILED = 'failed';
}
