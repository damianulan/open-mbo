<?php

namespace App\Enums\Mbo;

use App\Support\Concerns\EnumHasValues;

enum UserObjectiveStatus: string
{
    use EnumHasValues;

    case UNSTARTED = 'unstarted';

    /**
     * Objective in progress - can be marked as completed when deadline is not set and adding eveluation is possible
     */
    case PROGRESS = 'progress';

    /**
     * Evaluation is in progress
     */
    case COMPLETED = 'completed';

    /**
     * Objective marked as passed
     */
    case PASSED = 'passed';

    /**
     * Objective marked as failed
     */
    case FAILED = 'failed';

    /**
     * Objective interrupted - when involved in interrupted campaign or inactive campaign assignment
     */
    case INTERRUPTED = 'interrupted';

    /**
     * Frozen values are not editable by most system processes that automatically change status..
     * Passed, Failed, Interrupted
     */
    public static function frozen(): array
    {
        return [
            self::PASSED->value,
            self::FAILED->value,
            self::INTERRUPTED->value,
        ];
    }

    /**
     * Passed, Failed
     */
    public static function evaluated(): array
    {
        return [
            self::PASSED->value,
            self::FAILED->value,
        ];
    }

    /**
     * Completed, Passed, Failed
     */
    public static function finished(): array
    {
        return [
            self::COMPLETED->value,
            self::PASSED->value,
            self::FAILED->value,
        ];
    }

    /**
     * Completed, Passed, Failed, Interrupted
     */
    public static function inactive(): array
    {
        return [
            self::COMPLETED->value,
            self::PASSED->value,
            self::FAILED->value,
            self::INTERRUPTED->value,
        ];
    }

    public function label(): string
    {
        return __('mbo.objective_status.' . $this->value);
    }
}
