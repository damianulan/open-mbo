<?php

namespace App\View\Components\MBO\Campaign;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignUsersList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $userCampaigns) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign.campaign-users-list');
    }
}
