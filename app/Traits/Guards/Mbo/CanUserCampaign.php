<?php

namespace App\Traits\Guards\Mbo;

use App\Enums\Mbo\CampaignStage;
use App\Models\Mbo\Campaign;
use Illuminate\Support\Facades\Auth;

/**
 * @var Campaign $this
 * @author Damian Ułan <damian.ulan@protonmail.com>
 */
trait CanUserCampaign
{
    public function objectivesCanBeEvaluated(): bool
    {
        return $this->stage === CampaignStage::EVALUATION || settings('mbo.campaigns_ignore_dates');
    }

    public function objectivesCanBeSelfEvaluated(): bool
    {
        return Auth::user()->id === $this->user_id && ($this->stage === CampaignStage::SELF_EVALUATION || settings('mbo.campaigns_ignore_dates'));
    }
}
