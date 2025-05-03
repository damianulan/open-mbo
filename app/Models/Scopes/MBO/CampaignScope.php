<?php

namespace App\Models\Scopes\MBO;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use App\Enums\Core\PermissionLib;
use App\Models\MBO\Campaign;
use App\Models\Core\Role;
use App\Enums\Core\SystemRolesLib;

class CampaignScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user->cannot(PermissionLib::MBO_ADMINISTRATION)) {
            if ($user->can(PermissionLib::MBO_CAMPAIGN_VIEW)) {
                $campaignRoleId = Role::getId(SystemRolesLib::CAMPAIGN_COORDINATOR);
                $campaign_ids = $user->roleAssignments()->where('role_id', $campaignRoleId)->where('context_type', Campaign::class)->get()->pluck('context_id');

                $builder->whereIn('id', $campaign_ids);
            } else {
                $builder->whereRaw('1=0');
            }
        }
    }
}
