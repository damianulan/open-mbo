<?php

namespace App\Services\Teams;

use App\Models\Business\Team;
use Lucent\Services\Service;

final class CreateOrUpdate extends Service
{
    public function handle(): Team
    {
        $teamId = $this->team->id ?? null;
        $leadersIds = $this->request()->input('leaders_ids') ?? [];
        $team = Team::fillFromRequest($teamId);
        $usersIds = $this->request()->input('users_ids') ?? [];
        $usersIds = array_values(array_unique(array_merge($usersIds, $leadersIds)));
        $team->leader_id = collect($leadersIds)->first();

        if ($team->save()) {
            $team->refreshUsers($usersIds);
            $team->refreshLeaderRoles($leadersIds);
            $this->team = $team;
        }

        return $team;
    }
}
