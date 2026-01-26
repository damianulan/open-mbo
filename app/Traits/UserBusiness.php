<?php

namespace App\Traits;

use App\Models\Business\Team;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Sentinel\Models\Role;

trait UserBusiness
{
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'users_teams');
    }

    public function leader_teams()
    {
        return $this->hasMany(Team::class, 'leader_id');
    }

    public function employment(): ?HasOne
    {
        return $this->hasOne(UserEmployment::class)->active()->orderBy('created_at', 'desc');
    }

    public function employments(): ?HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function employments_active(): ?HasMany
    {
        return $this->hasMany(UserEmployment::class)->active();
    }

    public function current_employment()
    {
        return $this->employments_active()->first();
    }

    public function hasEmployment(): bool
    {
        return $this->employments_active()->count() ? true : false;
    }

    public function supervisors()
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', null, 'model_id')->where('role_id', Role::getId('supervisor'));
    }

    public function subordinates()
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', 'model_id', 'context_id')->where('role_id', Role::getId('supervisor'));
    }

    public function hasSupervisor($supervisor_id): bool
    {
        return $this->supervisors->contains('id', $supervisor_id);
    }

    public function hasSubordinate($subordinate_id): bool
    {
        return $this->subordinates->contains('id', $subordinate_id);
    }

    public function isSupervisor(): bool
    {
        return $this->subordinates()->count() ? true : false;
    }

    public function isSupervisorTo(User $user): bool
    {
        return $this->subordinates->contains($user);
    }

    public function assignSupervisor(...$supervisor_ids): bool
    {
        foreach ($supervisor_ids as $id) {
            $supervisor = static::find($id);
            if ($supervisor->exists && ! $this->hasSupervisor($id)) {
                $this->supervisors()->attach($supervisor, ['model_type' => static::class, 'role_id' => Role::getId('supervisor')]);
            }
        }

        return true;
    }

    public function revokeSupervisor(...$supervisor_ids)
    {
        foreach ($supervisor_ids as $id) {
            $this->supervisors()->detach($id);
        }

        return true;
    }

    public function refreshSupervisors(?array $user_ids)
    {
        if ( ! $user_ids) {
            $user_ids = [];
        }

        $current = $this->supervisors->pluck('id')->toArray();
        $toDelete = array_filter($current, fn ($value) => ! in_array($value, $user_ids));
        $toAdd = array_filter($user_ids, fn ($value) => ! in_array($value, $current));

        foreach ($toDelete as $user_id) {
            $this->revokeSupervisor($user_id);
        }
        foreach ($toAdd as $user_id) {
            $this->assignSupervisor($user_id);
        }

        return true;
    }
}
