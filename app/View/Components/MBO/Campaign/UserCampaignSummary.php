<?php

namespace App\View\Components\MBO\Campaign;

use App\Enums\MBO\UserObjectiveStatus;
use App\Models\MBO\UserCampaign;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class UserCampaignSummary extends Component
{
    /**
     * Create a new component instance.
     */
    public int $objectivesCount = 0;

    public int $objectivesFinishedCount = 0;

    public int $objectivesEvaluatedCount = 0;

    /**
     * @var array<string, int>
     */
    public array $objectiveStatusCounts = [];

    public function __construct(public UserCampaign $userCampaign)
    {
        $userObjectives = $this->userCampaign->user_objectives;

        $this->objectivesCount = $userObjectives->count();
        $this->objectiveStatusCounts = $this->statusCounts($userObjectives);

        $this->objectivesFinishedCount = $userObjectives
            ->whereIn('status', UserObjectiveStatus::finished())
            ->count();

        $this->objectivesEvaluatedCount = $userObjectives
            ->whereIn('status', UserObjectiveStatus::evaluated())
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.campaign.user-campaign-summary');
    }

    /**
     * @return array<string, int>
     */
    private function statusCounts(Collection $userObjectives): array
    {
        return $userObjectives
            ->groupBy(fn ($userObjective) => $userObjective->status)
            ->map(fn (Collection $items): int => $items->count())
            ->all();
    }
}
