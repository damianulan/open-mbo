<?php

namespace App\Traits\Guards\MBO;

use App\Enums\MBO\CampaignStage;
use Illuminate\Support\Facades\Auth;

/**
 * @var \App\Models\MBO\Campaign $this
 *
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2025 damianulan
 */
trait CanUserCampaign
{
    /**
     * If campaign objectives can be evaluated by a superior user.
     */
    public function objectivesCanBeEvaluated(): bool
    {
        return $this->stage === CampaignStage::EVALUATION || settings('mbo.campaigns_ignore_dates');
    }

    public function objectivesCanBeSelfEvaluated(): bool
    {
        return Auth::user()->id === $this->user_id && ($this->stage === CampaignStage::SELF_EVALUATION || settings('mbo.campaigns_ignore_dates'));
    }
}
