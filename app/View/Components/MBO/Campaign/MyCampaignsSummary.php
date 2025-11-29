<?php

namespace App\View\Components\MBO\Campaign;

use App\Models\Core\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MyCampaignsSummary extends Component
{
    public User $user;

    public Collection $userCampaigns;

    /**
     * Create a new component instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        if ( ! $user->exists) {
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
