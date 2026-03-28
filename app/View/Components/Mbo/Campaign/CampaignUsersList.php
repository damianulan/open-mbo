<?php

namespace App\View\Components\Mbo\Campaign;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CampaignUsersList extends Component
{
    public function __construct(public $userCampaigns) {}

    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign.campaign-users-list');
    }
}
