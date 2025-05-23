<?php

namespace App\Enums\MBO;

use App\Facades\Enum;

class UserObjectiveStatus extends Enum
{
    const UNSTARTED = 'unstarted';

    /**
     * Objective in progress - can be marked as completed when deadline is not set and adding eveluation is possible
     */
    const PROGRESS = 'progress';

    /**
     * Evaluation is in progress
     */
    const COMPLETED = 'completed';

    /**
     * Objective marked as passed
     */
    const PASSED = 'passed';

    /**
     * Objective marked as failed
     */
    const FAILED = 'failed';

    /**
     * Objective interrupted - when involved in interrupted campaign or inactive campaign assignment
     */
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
            self::INTERRUPTED
        ];
    }

    public static function evaluated(): array
    {
        return [
            self::PASSED,
            self::FAILED,
        ];
    }

    public static function inactive(): array
    {
        return [
            self::COMPLETED,
            self::PASSED,
            self::FAILED,
            self::INTERRUPTED,
        ];
    }
}
