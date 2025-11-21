<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class MBOSettings extends BaseSettings
{
    public bool $enabled = true;

    /**
     * If it is possible to aggregate objectives into campaigns.
     */
    public bool $campaigns_enabled = true;

    /**
     * If campaigns allow manual stage assignment.
     */
    public bool $campaigns_manual = true;

    /**
     * Percentage bonus for passing all objectives in campaign.
     * Bonus is assigned to calculated rewards from all objectives in campaign.
     */
    public float $campaigns_bonus = 10.00;

    /**
     * Allow to make actions default to certain stages if stage is not active.
     */
    public bool $campaigns_ignore_dates = true;

    /**
     * Autofail objectives when deadline reached.
     */
    public bool $objectives_autofail = true;

    /**
     * Allow administrators to evaluate their own objectives.
     *
     * @var bool
     */
    public bool $objectives_self_final_evaluation = true;

    /**
     * If weights are enabled. If not, every objective's weight equals to 1
     *
     * @var bool
     */
    public bool $objectives_weights = true;

    /**
     * Enable rewards for passing objectives.
     */
    public bool $rewards = true;

    /**
     * Calculate rewards proportionally to an evaluation. Otherwise, when passed, always assign 100% of the reward.
     */
    public bool $rewards_proportional;

    /**
     * Enable manipulation of calculated rewards by admins and evaluators.
     */
    public bool $manipulate_rewards;

    /**
     * Adds rewards for failed objectives, proportionally to an evaluation.
     */
    public bool $failed_rewards;

    /**
     * 1 unit of a current currency equals to x points.
     */
    public float $rewards_points_exchange;

    /**
     * Min evaluation percentage required to pass an objective.
     */
    public float $rewards_min_evaluation;

    /**
     * Currency used for presenting values of rewards.
     */
    public string $rewards_currency;

    public static function group(): string
    {
        return 'mbo';
    }
}
