<?php

namespace App\Policies\MBO;

use App\Models\Core\User;
use App\Models\MBO\Campaign;

class CampaignPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('mbo-campaign-view');
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
        return $user->can('mbo-campaign-view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('mbo-campaign-create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Campaign $campaign): bool
    {
        return $user->can('mbo-campaign-update', $campaign);
    }

    /**
     * dodawanie/usuwanie użytkowników i celów do/z kampanii.
     */
    public function users(User $user, Campaign $campaign): bool
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-users', $campaign);
    }

    public function objectives(User $user, Campaign $campaign): bool
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-objectives', $campaign);
    }

    public function manual(User $user, Campaign $campaign): bool
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-manual', $campaign);
    }

    public function terminate(User $user, Campaign $campaign): bool
    {
        return ($campaign->isActive() || $campaign->terminated()) && $user->can('mbo-campaign-terminate', $campaign);
    }

    public function cancel(User $user, Campaign $campaign): bool
    {
        return $campaign->isActive() && $user->can('mbo-campaign-cancel', $campaign);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Campaign $campaign): bool
    {
        return $user->can('mbo-campaign-delete', $campaign);
    }
}
