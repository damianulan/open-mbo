<?php

namespace App\View\Components\MBO\Campaign;

use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Campaign $campaign, public UserCampaign $userCampaign = new UserCampaign()) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign-card');
    }
}
