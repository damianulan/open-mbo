<?php

namespace App\Contracts\Repositories;

use App\Models\Core\User;
use App\Models\Mbo\UserCampaign;
use Illuminate\Database\Eloquent\Collection;

interface UserCampaignRepositoryContract
{
    public function getMyCampaignsForUser(User $user): Collection;

    public function find(int|string $id, array $relations = []): ?UserCampaign;

    public function findOrFail(int|string $id, array $relations = []): UserCampaign;

    public function findForShow(int|string $id): UserCampaign;

    public function getAssignedUserIdsForCampaign(int|string $campaignId): array;

    public function getAssignmentsForCampaign(int|string $campaignId): Collection;
}
