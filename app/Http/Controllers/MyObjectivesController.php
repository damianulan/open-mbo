<?php

namespace App\Http\Controllers;

use App\Enums\MBO\UserObjectiveStatus;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use App\Models\MBO\UserPoints;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MyObjectivesController extends AppController
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $inactiveStatuses = UserObjectiveStatus::inactive();

        $userObjectives = UserObjective::query()
            ->my($user)
            ->join('objectives', 'objectives.id', '=', 'user_objectives.objective_id')
            ->where('objectives.draft', 0)
            ->with([
                'points',
            ])
            ->select('user_objectives.*')
            ->orderByRaw(
                "CASE WHEN user_objectives.status IN ('" . implode("','", $inactiveStatuses) . "') THEN 1 ELSE 0 END ASC",
            )
            ->orderByRaw('objectives.deadline IS NULL, objectives.deadline ASC')
            ->orderByDesc('user_objectives.updated_at')
            ->limit(50)
            ->get();

        $userObjectives->load([
            'objective' => function ($query): void {
                $query->withoutGlobalScopes()->with(['campaign', 'category']);
            },
        ]);

        $userCampaigns = $user->campaigns()
            ->orderForUser()
            ->get();

        $userCampaigns->load([
            'campaign' => function ($query): void {
                $query->withoutGlobalScopes();
            },
        ]);

        $totalPoints = (float) UserPoints::query()
            ->whereUserId($user->id)
            ->sum('points');

        $recentPoints = UserPoints::query()
            ->whereUserId($user->id)
            ->with(['assigner'])
            ->with(['subject' => function (MorphTo $morphTo): void {
                $morphTo->morphWith([
                    UserObjective::class => ['objective'],
                    UserCampaign::class => ['campaign'],
                ]);
            }])
            ->latest()
            ->limit(10)
            ->get();

        return view('pages.my-objectives.index', [
            'user' => $user,
            'userObjectives' => $userObjectives,
            'userCampaigns' => $userCampaigns,
            'totalPoints' => $totalPoints,
            'recentPoints' => $recentPoints,
            'objectiveStatusCounts' => $userObjectives->countBy('status'),
        ]);
    }
}
