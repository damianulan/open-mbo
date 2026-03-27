<?php

namespace App\Traits\Guards\Mbo;

use App\Enums\Mbo\CampaignStage;
use App\Models\Mbo\Campaign;
use Illuminate\Support\Facades\Auth;

/**
 * @var Campaign $this
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
        return CampaignStage::EVALUATION === $this->stage || settings('mbo.campaigns_ignore_dates');
    }

    public function objectivesCanBeSelfEvaluated(): bool
    {
        return Auth::user()->id === $this->user_id && (CampaignStage::SELF_EVALUATION === $this->stage || settings('mbo.campaigns_ignore_dates'));
    }
}
