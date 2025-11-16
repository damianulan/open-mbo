<?php

namespace App\View\Components\MBO\Campaign;

use App\Contracts\MBO\HasObjectives;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class CampaignCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Campaign $campaign) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign-card');
    }
}
