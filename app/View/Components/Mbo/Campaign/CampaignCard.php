<?php

namespace App\View\Components\Mbo\Campaign;

use App\Models\Mbo\Campaign;
use App\Models\Mbo\UserCampaign;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignCard extends Component
{
    public function __construct(public Campaign $campaign, public ?UserCampaign $userCampaign = null) {}

    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign-card');
    }
}
