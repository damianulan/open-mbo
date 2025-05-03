<?php

namespace App\Models\Scopes\MBO;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\MBO\Objective;
use Illuminate\Support\Facades\Auth;
use App\Enums\Core\PermissionLib;
use App\Models\MBO\ObjectiveTemplateCategory;
use Illuminate\Database\Query\JoinClause;
use App\Models\MBO\Campaign;
use App\Models\Core\Role;
use App\Enums\Core\SystemRolesLib;

class ObjectiveScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user->cannot(PermissionLib::MBO_ADMINISTRATION)) {
            if ($user->can(PermissionLib::MBO_OBJECTIVE_VIEW)) {
                $objectiveRoleId = Role::getId(SystemRolesLib::OBJECTIVE_COORDINATOR);
                $campaignRoleId = Role::getId(SystemRolesLib::CAMPAIGN_COORDINATOR);

                // allow access for objective coordinators
                $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                // allow access for campaign coordinators if objective is assigned to campaign
                $campaign_ids = $user->roleAssignments()->where('role_id', $campaignRoleId)->where('context_type', Campaign::class)->get()->pluck('context_id');
                $hasAny = $category_ids->count() || $campaign_ids->count();

                if ($hasAny) {
                    $builder->join('objective_templates', function (JoinClause $join) {
                        $join->on('objectives.template_id', '=', 'objective_templates.id');
                    })

                        ->where(function (Builder $q) use ($category_ids, $campaign_ids) {
                            $q->whereIn('objective_templates.category_id', $category_ids)
                                ->orWhereIn('objectives.campaign_id', $campaign_ids);
                        });

                    $builder->select('objectives.*');
                } else {
                    $builder->whereRaw('1=0');
                }
            } else {
                $builder->whereRaw('1=0');
            }
        }
    }
}
