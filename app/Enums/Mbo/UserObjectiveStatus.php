<?php

namespace App\Enums\Mbo;

use App\Support\Concerns\EnumHasValues;

enum UserObjectiveStatus: string
{
    use EnumHasValues;

    case UNSTARTED = 'unstarted';

    case PROGRESS = 'progress';

    case COMPLETED = 'completed';

    case PASSED = 'passed';

    case FAILED = 'failed';

    case INTERRUPTED = 'interrupted';

    public static function frozen(): array
    {
        return [
            self::PASSED->value,
            self::FAILED->value,
            self::INTERRUPTED->value,
        ];
    }

    public static function evaluated(): array
    {
        return [
            self::PASSED->value,
            self::FAILED->value,
        ];
    }

    public static function finished(): array
    {
        return [
            self::COMPLETED->value,
            self::PASSED->value,
            self::FAILED->value,
        ];
    }

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
