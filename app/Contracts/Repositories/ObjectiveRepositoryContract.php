<?php

namespace App\Contracts\Repositories;

use App\Models\Mbo\Objective;
use Illuminate\Database\Eloquent\Builder;

interface ObjectiveRepositoryContract
{
    public function queryForDataTable(): Builder;

    public function find(int|string $id, array $relations = []): ?Objective;

    public function findOrFail(int|string $id, array $relations = []): Objective;

    public function findForShow(int|string $id): Objective;
}
