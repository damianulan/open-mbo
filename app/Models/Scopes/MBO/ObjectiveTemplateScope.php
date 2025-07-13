<?php

namespace App\Models\Scopes\MBO;

use App\Models\MBO\ObjectiveTemplateCategory;
use App\Warden\PermissionsLib;
use App\Warden\RolesLib;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Sentinel\Models\Role;

class ObjectiveTemplateScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user->cannot(PermissionsLib::MBO_ADMINISTRATION)) {
            if ($user->can(PermissionsLib::MBO_TEMPLATES_VIEW)) {
                $objectiveRoleId = Role::getId(RolesLib::OBJECTIVE_COORDINATOR);
                $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                $builder->whereIn('category_id', $category_ids);
            } else {
                $builder->whereRaw('1=0');
            }
        }
    }
}
