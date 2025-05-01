<?php

namespace App\Models\Scopes\MBO;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\MBO\ObjectiveTemplateCategory;
use Illuminate\Support\Facades\Auth;
use App\Enums\Core\PermissionLib;
use App\Models\Core\Role;

class ObjectiveTemplateScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        $coordinatorRoleId = Role::getId($model->contextualRole);

        if ($user->cannot(PermissionLib::MBO_ADMINISTRATION)) {
            $category_ids = $user->roleAssignments()->where('role_id', $coordinatorRoleId)->where('context_type', ObjectiveTemplateCategory::class)->get()->pluck('context_id');

            $builder->whereIn('category_id', $category_ids);
        }
    }
}
