<?php

namespace App\Models\Scopes\Users;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CoreUsersScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if(Auth::check()){
            if(Auth::user()->isRoot()){
                $builder->where('core', 0);
            }
        }
    }
}
