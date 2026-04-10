<?php

namespace App\Repositories\Mbo;

use App\Contracts\Repositories\UserObjectiveRepositoryContract;
use App\Models\Core\User;
use App\Models\Mbo\Objective;
use App\Models\Mbo\UserObjective;
use Illuminate\Database\Eloquent\Collection;

class UserObjectiveRepository implements UserObjectiveRepositoryContract
{
    public function getMyObjectivesForUser(User $user, array $inactiveStatuses, int $limit = 50): Collection
    {
        $objectiveDeadlineSubquery = Objective::query()
            ->withoutGlobalScopes()
            ->select('deadline')
            ->whereColumn('objectives.id', 'user_objectives.objective_id')
            ->limit(1);

        return UserObjective::query()
            ->my($user)
            ->whereHas('objective', function ($query): void {
                $query->withoutGlobalScopes()->where('draft', 0);
            })
            ->withSum('pointEntries as gained_points', 'points')
            ->with([
                'objective' => function ($query): void {
                    $query->withoutGlobalScopes()->with([
                        'campaign' => fn ($campaignQuery) => $campaignQuery->withoutGlobalScopes(),
                        'category',
                    ]);
                },
            ])
            ->orderByRaw(
                "CASE WHEN user_objectives.status IN ('" . implode("','", $inactiveStatuses) . "') THEN 1 ELSE 0 END ASC",
            )
            ->orderByRaw('(' . $objectiveDeadlineSubquery->toSql() . ') IS NULL ASC', $objectiveDeadlineSubquery->getBindings())
            ->orderBy($objectiveDeadlineSubquery)
            ->orderByDesc('user_objectives.updated_at')
            ->limit($limit)
            ->get();
    }

    public function find(int|string $id, array $relations = []): ?UserObjective
    {
        return UserObjective::query()
            ->with($relations)
            ->find($id);
    }

    public function findOrFail(int|string $id, array $relations = []): UserObjective
    {
        return UserObjective::query()
            ->with($relations)
            ->findOrFail($id);
    }

    public function findForShow(int|string $id): UserObjective
    {
        return $this->findOrFail($id, [
            'user.profile',
            'objective.category',
            'objective.campaign',
            'points',
        ]);
    }

    public function getAssignedUserIdsForObjective(int|string $objectiveId): array
    {
        return UserObjective::query()
            ->where('objective_id', $objectiveId)
            ->pluck('user_id')
            ->all();
    }

    public function getAssignmentsForObjective(int|string $objectiveId): Collection
    {
        return UserObjective::query()
            ->where('objective_id', $objectiveId)
            ->get();
    }
}
