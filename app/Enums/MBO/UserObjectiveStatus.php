<?php

namespace App\Enums\MBO;

use App\Facades\Enum;

class UserObjectiveStatus extends Enum
{
    const UNSTARTED = 'unstarted';
    const PROGRESS = 'progress';
    const COMPLETED = 'completed';
    const PASSED = 'passed';
    const FAILED = 'failed';
    const INTERRUPTED = 'interrupted';

    /**
     * Frozen values are not editable by most system processes that automatically change status..
     *
     * @return array
     */
    public static function frozen(): array
    {
        return [
            self::PASSED,
            self::FAILED,
        ];
    }
}
