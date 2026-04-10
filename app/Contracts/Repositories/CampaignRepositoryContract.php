<?php

namespace App\Contracts\Repositories;

use App\Filters\Collections\CampaignsListFilters;
use App\Models\Mbo\Campaign;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CampaignRepositoryContract
{
    public function paginateForIndex(CampaignsListFilters $filters, int $perPage = 30): LengthAwarePaginator;

    public function loadForShow(Campaign $campaign): Campaign;

    public function find(int|string $id, array $relations = []): ?Campaign;

    public function findOrFail(int|string $id, array $relations = []): Campaign;
}
