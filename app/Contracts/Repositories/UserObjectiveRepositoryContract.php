<?php

namespace App\Contracts\Repositories;

use App\Models\Core\User;
use App\Models\Mbo\UserObjective;
use Illuminate\Database\Eloquent\Collection;

interface UserObjectiveRepositoryContract
{
    public function getMyObjectivesForUser(User $user, array $inactiveStatuses, int $limit = 50): Collection;

    public function find(int|string $id, array $relations = []): ?UserObjective;

    public function findOrFail(int|string $id, array $relations = []): UserObjective;

    public function findForShow(int|string $id): UserObjective;

    public function getAssignedUserIdsForObjective(int|string $objectiveId): array;

    public function getAssignmentsForObjective(int|string $objectiveId): Collection;
}
