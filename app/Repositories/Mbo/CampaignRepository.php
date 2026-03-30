<?php

namespace App\Repositories\Mbo;

use App\Contracts\Repositories\CampaignRepositoryContract;
use App\Filters\Collections\CampaignsListFilters;
use App\Models\Mbo\Campaign;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CampaignRepository implements CampaignRepositoryContract
{
    public function paginateForIndex(CampaignsListFilters $filters, int $perPage = 30): LengthAwarePaginator
    {
        return Campaign::query()
            ->withCount(['user_campaigns', 'objectives'])
            ->orderByStatus()
            ->registerFilters($filters)
            ->paginate($perPage);
    }

    public function loadForShow(Campaign $campaign): Campaign
    {
        $campaign->loadMissing([
            'coordinators.profile',
            'user_campaigns.user.profile',
            'objectives.category',
        ]);

        return $campaign;
    }

    public function find(int|string $id, array $relations = []): ?Campaign
    {
        return Campaign::query()
            ->with($relations)
            ->find($id);
    }

    public function findOrFail(int|string $id, array $relations = []): Campaign
    {
        return Campaign::query()
            ->with($relations)
            ->findOrFail($id);
    }
}
