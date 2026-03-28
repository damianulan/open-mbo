<?php

namespace App\Policies\Mbo;

use App\Enums\Mbo\CampaignStage;
use App\Models\Core\User;
use App\Models\Mbo\Campaign;
use App\Warden\PermissionsLib;
use Illuminate\Auth\Access\Response;

class CampaignPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->can(PermissionsLib::MBO_CAMPAIGN_VIEW) ? Response::allow() : Response::deny();
    }

    public function preview(User $user, Campaign $campaign): Response
    {
        return $user->isAdmin() ? Response::allow() : Response::deny();
    }

    public function view(User $user, Campaign $campaign): Response
    {
        return $user->can(PermissionsLib::MBO_CAMPAIGN_VIEW, $campaign) ? Response::allow() : Response::deny();
    }

    public function create(User $user): Response
    {
        return $user->can(PermissionsLib::MBO_CAMPAIGN_CREATE) ? Response::allow() : Response::deny();
    }

    public function update(User $user, Campaign $campaign): Response
    {
        return $user->can('mbo-campaign-update', $campaign) ? Response::allow() : Response::deny();
    }

    public function users(User $user, Campaign $campaign): Response
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-users', $campaign) && ($this->checkStage($campaign, CampaignStage::DEFINITION) || $this->checkStage($campaign, CampaignStage::DISPOSITION)) ? Response::allow() : Response::deny();
    }

    public function objectives(User $user, Campaign $campaign): Response
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-objectives', $campaign) && $this->checkStage($campaign, CampaignStage::DEFINITION) ? Response::allow() : Response::deny();
    }

    public function manual(User $user, Campaign $campaign): Response
    {
        return $campaign->isActive() && $user->can('mbo-campaign-manage-manual', $campaign) ? Response::allow() : Response::deny();
    }

    public function terminate(User $user, Campaign $campaign): Response
    {
        return ($campaign->isActive() || $campaign->terminated()) && $user->can('mbo-campaign-terminate', $campaign) ? Response::allow() : Response::deny();
    }

    public function cancel(User $user, Campaign $campaign): Response
    {
        return $campaign->isActive() && $user->can('mbo-campaign-cancel', $campaign) ? Response::allow() : Response::deny();
    }

    public function resume(User $user, Campaign $campaign): Response
    {
        return $campaign->canceled() && $user->can('mbo-campaign-cancel', $campaign) ? Response::allow() : Response::deny();
    }

    public function delete(User $user, Campaign $campaign): Response
    {
        return $user->can('mbo-campaign-delete', $campaign) ? Response::allow() : Response::deny();
    }

    private function checkStage(Campaign $campaign, CampaignStage|string $stage): Response
    {
        return $campaign->isStageActive($stage) || settings('mbo.campaigns_ignore_dates') ? Response::allow() : Response::deny();
    }
}
