<?php

namespace App\View\Components\Mbo\Campaign;

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

    public function __construct(User $user)
    {
        if (! $user->exists) {
            $user = Auth::user();
        }

        $this->user = $user;
        $this->user->loadMissing([
            'campaigns.campaign' => fn ($query) => $query->withCount(['user_campaigns', 'objectives']),
            'campaigns.user_objectives.objective',
            'campaigns.user_objectives.points',
        ]);
        $this->userCampaigns = $user->campaigns;
    }

    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign.my-campaigns-summary');
    }
}
