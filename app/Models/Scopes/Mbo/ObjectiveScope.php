<?php

namespace App\Models\Scopes\Mbo;

use App\Models\Mbo\Campaign;
use App\Models\Mbo\ObjectiveTemplateCategory;
use App\Warden\PermissionsLib;
use App\Warden\RolesLib;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Sentinel\Models\Role;
use Throwable;

class ObjectiveScope implements Scope
{
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

                        $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', 'like', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                        $campaign_ids = $user->roleAssignments()->where('role_id', $campaignRoleId)->where('context_type', Campaign::class)->get()->pluck('context_id');
                        $hasAny = $category_ids->count() || $campaign_ids->count();

                        if ($hasAny) {
                            $builder->where(function (Builder $query) use ($category_ids, $campaign_ids): void {
                                $query->whereHas('template', function (Builder $templateQuery) use ($category_ids): void {
                                    $templateQuery->whereIn('category_id', $category_ids);
                                })->orWhereIn('objectives.campaign_id', $campaign_ids);
                            });
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
