<?php

namespace App\Models\Scopes\MBO;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use App\Enums\Core\PermissionLib;
use App\Models\Core\Role;
use App\Models\MBO\Campaign;

class CampaignScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        $coordinatorRoleId = Role::getId($model->contextualRole);
    }
}
