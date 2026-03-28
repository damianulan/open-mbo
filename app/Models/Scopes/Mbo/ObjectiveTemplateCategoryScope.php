<?php

namespace App\Models\Scopes\Mbo;

use App\Models\Mbo\ObjectiveTemplateCategory;
use App\Warden\PermissionsLib;
use App\Warden\RolesLib;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Sentinel\Models\Role;

class ObjectiveTemplateCategoryScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->cannot(PermissionsLib::MBO_ADMINISTRATION)) {
                if ($user->can(PermissionsLib::MBO_CATEGORIES_VIEW)) {
                    $objectiveRoleId = Role::getId(RolesLib::OBJECTIVE_COORDINATOR);
                    $category_ids = $user->roleAssignments()->where('role_id', $objectiveRoleId)->where('context_type', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

                    $builder->whereIn('objective_template_categories.id', $category_ids);
                } else {
                    $builder->whereRaw('1=0');
                }
            }
        }
    }
}
