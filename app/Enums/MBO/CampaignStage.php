<?php

namespace App\Enums\MBO;

/**
 * Campaign Stages can be assigned to campaigns and users in campaign.
 *
 * Campaigns while in progress can have multiple SOFT STAGES assigned.
 * User can only have one of any STAGES assigned at a time.
 */
enum CampaignStage: string
{
    // in progress/soft stages - campaign can have multiple of them assigned.
    // if any assigned its generally an IN_PROGESS stage
    case DEFINITION = 'definition';
    case DISPOSITION = 'disposition';
    case REALIZATION = 'realization';
    case EVALUATION = 'evaluation';
    case SELF_EVALUATION = 'self_evaluation';

    // hard stages
    case PENDING = 'pending'; // starting point stage
    case IN_PROGRESS = 'in_progress'; // case when process is in progress
    case COMPLETED = 'completed'; // case when process is finished in time
    case TERMINATED = 'terminated'; // case when process has been terminated after it has started
    case CANCELED = 'canceled'; // case when process has been canceled

    public static function values(): array
    {
        $collection = array();
        foreach(self::cases() as $case){
            $collection[] = $case->value;
        }
        return $collection;
    }

    public static function hardValues(): array
    {
        return [
            self::PENDING->value,
            self::IN_PROGRESS->value,
            self::COMPLETED->value,
            self::TERMINATED->value,
            self::CANCELED->value,
        ];
    }

    public static function softValues(): array
    {
        return [
            self::DEFINITION->value,
            self::DISPOSITION->value,
            self::REALIZATION->value,
            self::EVALUATION->value,
            self::SELF_EVALUATION->value,
        ];
    }

    public static function sequences(): array
    {
        return [
            self::PENDING->value => 0,
            self::DEFINITION->value => 1,
            self::DISPOSITION->value => 2,
            self::REALIZATION->value => 3,
            self::EVALUATION->value => 4,
            self::SELF_EVALUATION->value => 5,
            self::COMPLETED->value => 6,
            self::TERMINATED->value => 6,
            self::CANCELED->value => 6,
        ];
    }
}
