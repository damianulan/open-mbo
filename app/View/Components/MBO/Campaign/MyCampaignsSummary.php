<?php

namespace App\View\Components\MBO\Campaign;

use App\Contracts\MBO\HasObjectives;
use App\Models\Core\User;
use App\Models\MBO\UserCampaign;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class MyCampaignsSummary extends Component
{
    public User $user;
    public Collection $userCampaigns;

    /**
     * Create a new component instance.
     */
    public function __construct(User $user)
    {
        if (!$user->exists) {
            $user = Auth::user();
        }

        $this->user = $user;
        $this->userCampaigns = $user->campaigns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign.my-campaigns-summary');
    }
}
