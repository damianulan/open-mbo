<?php

namespace App\Repositories\Mbo;

use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Models\Core\User;
use App\Models\Mbo\UserCampaign;
use Illuminate\Database\Eloquent\Collection;

class UserCampaignRepository implements UserCampaignRepositoryContract
{
    public function getMyCampaignsForUser(User $user): Collection
    {
        return $user->campaigns()
            ->orderForUser()
            ->with([
                'campaign' => function ($query): void {
                    $query->withoutGlobalScopes()->withCount([
                        'user_campaigns',
                        'objectives',
                    ]);
                },
                'user_objectives.objective' => fn ($query) => $query->withoutGlobalScopes(),
                'user_objectives.points',
            ])
            ->get();
    }

    public function find(int|string $id, array $relations = []): ?UserCampaign
    {
        return UserCampaign::query()
            ->with($relations)
            ->find($id);
    }

    public function findOrFail(int|string $id, array $relations = []): UserCampaign
    {
        return UserCampaign::query()
            ->with($relations)
            ->findOrFail($id);
    }

    public function findForShow(int|string $id): UserCampaign
    {
        return $this->findOrFail($id, [
            'campaign.coordinators.profile',
            'user.profile',
            'user_objectives.objective',
        ]);
    }

    public function getAssignedUserIdsForCampaign(int|string $campaignId): array
    {
        return UserCampaign::query()
            ->where('campaign_id', $campaignId)
            ->pluck('user_id')
            ->all();
    }

    public function getAssignmentsForCampaign(int|string $campaignId): Collection
    {
        return UserCampaign::query()
            ->where('campaign_id', $campaignId)
            ->get();
    }
}
