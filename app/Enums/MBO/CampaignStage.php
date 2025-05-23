<?php

namespace App\Enums\MBO;

use App\Facades\Enum;
use App\Enums\MBO\UserObjectiveStatus;

/**
 * Campaign Stages can be assigned to campaigns and users in campaign.
 *
 * Campaigns while in progress can have multiple SOFT STAGES assigned.
 * User can only have one of any STAGES assigned at a time.
 */
class CampaignStage extends Enum
{
    // in progress/soft stages - campaign can have multiple of them assigned.
    // if any assigned its generally an IN_PROGESS stage
    const DEFINITION = 'definition';
    const DISPOSITION = 'disposition';
    const REALIZATION = 'realization';
    const EVALUATION = 'evaluation';
    const SELF_EVALUATION = 'self_evaluation';

    // hard stages
    const PENDING = 'pending'; // starting point stage
    const IN_PROGRESS = 'in_progress'; // const when process is in progress
    const COMPLETED = 'completed'; // const when process is finished in time
    const TERMINATED = 'terminated'; // const when process has been terminated after it has started
    const CANCELED = 'canceled'; // const when process has been canceled

    public static function hardValues(): array
    {
        return [
            self::PENDING,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::TERMINATED,
            self::CANCELED,
        ];
    }

    public static function softValues(): array
    {
        return [
            self::DEFINITION,
            self::DISPOSITION,
            self::REALIZATION,
            self::EVALUATION,
            self::SELF_EVALUATION,
        ];
    }

    public static function sequences(): array
    {
        return [
            self::PENDING => 0,
            self::DEFINITION => 1,
            self::DISPOSITION => 2,
            self::REALIZATION => 3,
            self::EVALUATION => 4,
            self::SELF_EVALUATION => 5,
            self::COMPLETED => 6,
        ];
    }

    public static function getName(string $value): string
    {
        return __('forms.campaigns.' . $value);
    }

    public static function getInfo(string $value): string
    {
        return __('forms.campaigns.info.' . $value);
    }

    public static function getBySequence(int $sequence)
    {
        $stages = self::sequences();
        foreach ($stages as $key => $value) {
            if ($value === $sequence) {
                return $key;
            }
        }
    }

    public static function stageIcon($stage)
    {
        $status = null;
        switch ($stage) {
            case CampaignStage::PENDING:
                $status = 'bi-hourglass';
                break;

            case CampaignStage::DEFINITION:
            case CampaignStage::DISPOSITION:
                $status = 'bi-hourglass-top';
                break;

            case CampaignStage::REALIZATION:
            case CampaignStage::EVALUATION:
            case CampaignStage::SELF_EVALUATION:
                $status = 'bi-hourglass-split';
                break;

            default:
                $status = 'bi-hourglass-bottom';
                break;
        }
        return $status;
    }

    /**
     * @param string $stage - UserCampaign stage
     * @param string $status - UserObjective status
     * @return string $status
     */
    public static function mapObjectiveStatus(string $stage, string $status): string
    {
        $sequences = self::sequences();
        $frozen = UserObjectiveStatus::evaluated();

        if (array_key_exists($stage, $sequences) && !in_array($status, $frozen)) {
            if ($stage === self::REALIZATION || $stage === self::IN_PROGRESS) {
                $status = UserObjectiveStatus::PROGRESS;
            } elseif ($sequences[$stage] < $sequences[self::REALIZATION]) {
                $status = UserObjectiveStatus::UNSTARTED;
            } elseif ($sequences[$stage] > $sequences[self::REALIZATION]) {
                $status = UserObjectiveStatus::COMPLETED;
            }
        }

        return $status;
    }
}
