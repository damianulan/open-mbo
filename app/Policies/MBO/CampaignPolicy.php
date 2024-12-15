<?php

namespace App\Policies\MBO;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use Illuminate\Auth\Access\Response;

class CampaignPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function preview(User $user, Campaign $campaign): bool
    {
        return $user->isAdmin();
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Campaign $campaign): bool
    {
        $is_creator = $campaign->creator && $user->id === $creator->id;
        return $user->can('mbo-campaign-view', $campaign) || $is_creator;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('mbo-campaign-create', $campaign);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Campaign $campaign): bool
    {
        return $user->can('mbo-campaign-update', $campaign);
    }


    public function manage(User $user, Campaign $campaign): bool
    {
        return $user->can('mbo-campaign-manage', $campaign);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Campaign $campaign): bool
    {
        return $user->can('mbo-campaign-delete', $campaign);
    }

}
