<?php

namespace App\Enums\MBO;

use Enumerable\LaraEnum;

class UserObjectiveStatus extends LaraEnum
{
    public const UNSTARTED = 'unstarted';

    /**
     * Objective in progress - can be marked as completed when deadline is not set and adding eveluation is possible
     */
    public const PROGRESS = 'progress';

    /**
     * Evaluation is in progress
     */
    public const COMPLETED = 'completed';

    /**
     * Objective marked as passed
     */
    public const PASSED = 'passed';

    /**
     * Objective marked as failed
     */
    public const FAILED = 'failed';

    /**
     * Objective interrupted - when involved in interrupted campaign or inactive campaign assignment
     */
    public const INTERRUPTED = 'interrupted';

    /**
     * Frozen values are not editable by most system processes that automatically change status..
     * Passed, Failed, Interrupted
     */
    public static function frozen(): array
    {
        return array(
            self::PASSED,
            self::FAILED,
            self::INTERRUPTED,
        );
    }

    /**
     * Passed, Failed
     */
    public static function evaluated(): array
    {
        return array(
            self::PASSED,
            self::FAILED,
        );
    }

    /**
     * Completed, Passed, Failed
     */
    public static function finished(): array
    {
        return array(
            self::COMPLETED,
            self::PASSED,
            self::FAILED,
        );
    }

    /**
     * Completed, Passed, Failed, Interrupted
     */
    public static function inactive(): array
    {
        return array(
            self::COMPLETED,
            self::PASSED,
            self::FAILED,
            self::INTERRUPTED,
        );
    }

    public static function labels(): array
    {
        return array(
            self::UNSTARTED => __('mbo.objective_status.unstarted'),
            self::PROGRESS => __('mbo.objective_status.progress'),
            self::COMPLETED => __('mbo.objective_status.completed'),
            self::PASSED => __('mbo.objective_status.passed'),
            self::FAILED => __('mbo.objective_status.failed'),
            self::INTERRUPTED => __('mbo.objective_status.interrupted'),
        );
    }
}
