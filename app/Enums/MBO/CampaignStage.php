<?php

namespace App\Enums\MBO;

use Enumerable\Laravel\Enum;

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
    public const DEFINITION = 'definition';

    public const DISPOSITION = 'disposition';

    public const REALIZATION = 'realization';

    public const EVALUATION = 'evaluation';

    public const SELF_EVALUATION = 'self_evaluation';

    // hard stages
    public const PENDING = 'pending'; // starting point stage

    public const IN_PROGRESS = 'in_progress'; // const when process is in progress

    public const COMPLETED = 'completed'; // const when process is finished in time

    public const TERMINATED = 'terminated'; // const when process has been terminated after it has started

    public const CANCELED = 'canceled'; // const when process has been canceled

    /**
     * Pending, In Progress, Completed, Terminated, Canceled
     */
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

    /**
     * Definition, Disposition, Realization, Evaluation, Self Evaluation
     */
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

    /**
     * Pending, Definition, Disposition, Realization, Evaluation, Self Evaluation, Completed
     */
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

    /**
     * In Progress, Pending, Completed, Terminated, Canceled
     */
    public static function hardValuesOrder(): array
    {
        return [
            self::IN_PROGRESS,
            self::PENDING,
            self::COMPLETED,
            self::TERMINATED,
            self::CANCELED,
        ];
    }

    public static function getName(string $value): string
    {
        return self::labels()[$value] ?? $value;
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

            case CampaignStage::TERMINATED:
                $status = 'bi-pause-circle-fill';
                break;

            case CampaignStage::CANCELED:
                $status = 'bi-x-circle-fill';
                break;

            default:
                $status = 'bi-hourglass-bottom';
                break;
        }

        return $status;
    }

    /**
     * set user objective status based on current user campaign stage.
     *
     * @param  string  $stage  - UserCampaign stage
     * @param  string|null  $status  - UserObjective status
     * @return string $status
     */
    public static function mapObjectiveStatus(string $stage, ?string $status): ?string
    {
        $sequences = self::sequences();
        $frozen = UserObjectiveStatus::evaluated();

        if (array_key_exists($stage, $sequences) && ! in_array($status, $frozen)) {
            if (self::REALIZATION === $stage || self::IN_PROGRESS === $stage) {
                $status = UserObjectiveStatus::PROGRESS;
            } elseif ($sequences[$stage] < $sequences[self::REALIZATION]) {
                $status = UserObjectiveStatus::UNSTARTED;
            } elseif ($sequences[$stage] > $sequences[self::REALIZATION]) {
                $status = UserObjectiveStatus::COMPLETED;
            }
        }

        return $status;
    }

    public static function labels(): array
    {
        return __('forms.campaigns.stages');
    }

    public static function fromto_labels(): array
    {
        $arr = [];
        foreach (__('forms.campaigns.stages') as $key => $value) {
            $arr[$key . '_from'] = $value . ' ' . __('forms.from');
            $arr[$key . '_to'] = $value . ' ' . __('forms.to');
        }

        return $arr;
    }
}
