<?php

namespace App\Policies\MBO;

use App\Enums\MBO\CampaignStage;
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
        return $campaign->isActive() && $user->can('mbo-campaign-manage-users', $campaign) && ($this->checkStage($campaign, CampaignStage::DEFINITION) || $this->checkStage($campaign, CampaignStage::DISPOSITION));
    }

    public function objectives(User $user, Campaign $campaign): bool
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-objectives', $campaign) && $this->checkStage($campaign, CampaignStage::DEFINITION);
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

    private function checkStage(Campaign $campaign, string $stage): bool
    {
        return $campaign->isStageActive($stage) || settings('mbo.campaigns_ignore_dates');
    }
}
