<?php

namespace App\Models\Scopes\MBO;

use App\Models\MBO\Campaign;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Warden\PermissionsLib;
use App\Warden\RolesLib;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Sentinel\Models\Role;
use Throwable;

class ObjectiveScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model): void
    {
        try {
            $builder->orderBy('objectives.deadline');
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->cannot(PermissionsLib::MBO_ADMINISTRATION)) {
                    if ($user->can(PermissionsLib::MBO_OBJECTIVE_VIEW)) {
                        $objectiveRoleId = Role::getId(RolesLib::OBJECTIVE_COORDINATOR);
                        $campaignRoleId = Role::getId(RolesLib::CAMPAIGN_COORDINATOR);

                        // allow access for objective coordinators
                        $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', 'like', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                        // allow access for campaign coordinators if objective is assigned to campaign
                        $campaign_ids = $user->roleAssignments()->where('role_id', $campaignRoleId)->where('context_type', Campaign::class)->get()->pluck('context_id');
                        $hasAny = $category_ids->count() || $campaign_ids->count();

                        if ($hasAny) {
                            $builder->join('objective_templates', function (JoinClause $join): void {
                                $join->on('objectives.template_id', '=', 'objective_templates.id');
                            })
                                ->where(function (Builder $q) use ($category_ids, $campaign_ids): void {
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
        } catch (Throwable $th) {
            report($th);
        }
    }
}
