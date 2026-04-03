<?php

namespace App\Repositories\Mbo;

use App\Contracts\Repositories\ObjectiveRepositoryContract;
use App\Models\Mbo\Objective;
use Illuminate\Database\Eloquent\Builder;

class ObjectiveRepository implements ObjectiveRepositoryContract
{
    public function queryForDataTable(): Builder
    {
        return Objective::query()->with([
            'campaign',
        ]);
    }

    public function find(int|string $id, array $relations = []): ?Objective
    {
        return Objective::query()
            ->with($relations)
            ->find($id);
    }

    public function findOrFail(int|string $id, array $relations = []): Objective
    {
        return Objective::query()
            ->with($relations)
            ->findOrFail($id);
    }

    public function findForShow(int|string $id): Objective
    {
        return $this->findOrFail($id, [
            'campaign',
            'category',
            'template.category.coordinators.profile',
            'template.category.coordinators.roles',
        ]);
    }
}
