<?php

namespace App\Http\Controllers\Objectives;

use App\Enums\Mbo\UserObjectiveStatus;
use App\Http\Controllers\AppController;
use App\Models\Mbo\UserCampaign;
use App\Models\Mbo\UserObjective;
use App\Models\Mbo\UserPoints;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class MyObjectivesController extends AppController
{
    public function index(Request $request): Renderable
    {
        $user = $request->user();

        $this->setPagetitle(__('menus.my_objectives.index'));
        $inactiveStatuses = UserObjectiveStatus::inactive();

        $userObjectives = UserObjective::query()
            ->my($user)
            ->join('objectives', 'objectives.id', '=', 'user_objectives.objective_id')
            ->where('objectives.draft', 0)
            ->select('user_objectives.*')
            ->withSum('pointEntries as gained_points', 'points')
            ->orderByRaw(
                "CASE WHEN user_objectives.status IN ('" . implode("','", $inactiveStatuses) . "') THEN 1 ELSE 0 END ASC",
            )
            ->orderByRaw('objectives.deadline IS NULL, objectives.deadline ASC')
            ->orderByDesc('user_objectives.updated_at')
            ->limit(50)
            ->get();

        $userObjectives->load([
            'objective' => function ($query): void {
                $query->withoutGlobalScopes()->with([
                    'campaign' => fn ($campaignQuery) => $campaignQuery->withoutGlobalScopes(),
                    'category',
                ]);
            },
        ]);

        $userCampaigns = $user->campaigns()
            ->orderForUser()
            ->get();

        $userCampaigns->load([
            'campaign' => function ($query): void {
                $query->withoutGlobalScopes()->withCount([
                    'user_campaigns',
                    'objectives',
                ]);
            },
        ]);

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
