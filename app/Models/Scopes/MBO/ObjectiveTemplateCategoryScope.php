<?php

namespace App\Models\Scopes\MBO;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\MBO\ObjectiveTemplateCategory;
use Illuminate\Support\Facades\Auth;
use App\Enums\Core\PermissionLib;
use App\Models\Core\Role;
use App\Enums\Core\SystemRolesLib;

class ObjectiveTemplateCategoryScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user->cannot(PermissionLib::MBO_ADMINISTRATION)) {
            if ($user->can(PermissionLib::MBO_CATEGORIES_VIEW)) {
                $objectiveRoleId = Role::getId(SystemRolesLib::OBJECTIVE_COORDINATOR);
                $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                $builder->whereIn('id', $category_ids);
            } else {
                $builder->whereRaw('1=0');
            }
        }
    }
}
