<?php

namespace App\Http\Controllers\Objectives;

use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Contracts\Repositories\UserObjectiveRepositoryContract;
use App\Enums\Mbo\UserObjectiveStatus;
use App\Http\Controllers\AppController;
use App\Models\Mbo\UserCampaign;
use App\Models\Mbo\UserObjective;
use App\Models\Mbo\UserPoints;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class MyObjectivesController extends AppController
{
    public function index(
        Request $request,
        UserObjectiveRepositoryContract $userObjectiveRepository,
        UserCampaignRepositoryContract $userCampaignRepository,
    ): Renderable {
        $user = $request->user();

        $this->setPagetitle(__('menus.my_objectives.index'));
        $inactiveStatuses = UserObjectiveStatus::inactive();
        $userObjectives = $userObjectiveRepository->getMyObjectivesForUser($user, $inactiveStatuses);
        $userCampaigns = $userCampaignRepository->getMyCampaignsForUser($user);

        $totalPoints = (float) UserPoints::query()
            ->whereUserId($user->id)
            ->sum('points');

        $recentPoints = UserPoints::query()
            ->whereUserId($user->id)
            ->with([
                'assigner',
                'subject',
            ])
            ->latest()
            ->limit(10)
            ->get();

        $recentPoints->loadMorph('subject', [
            UserObjective::class => [
                'objective' => fn ($query) => $query->withoutGlobalScopes(),
            ],
            UserCampaign::class => [
                'campaign' => fn ($query) => $query->withoutGlobalScopes(),
            ],
        ]);

        $completedObjectivesCount = $userObjectives
            ->filter(fn (UserObjective $userObjective) => $userObjective->isCompleted())
            ->count();

        return view('pages.my-objectives.index', [
            'user' => $user,
            'userObjectives' => $userObjectives,
            'userCampaigns' => $userCampaigns,
            'totalPoints' => $totalPoints,
            'recentPoints' => $recentPoints,
            'objectiveStatusCounts' => $userObjectives->countBy('status'),
            'completedObjectivesCount' => $completedObjectivesCount,
            'activeObjectivesCount' => $userObjectives->count() - $completedObjectivesCount,
        ]);
    }
}
