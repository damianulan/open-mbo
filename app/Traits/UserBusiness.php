<?php

namespace App\Traits;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Position;
use App\Models\Business\Team;
use App\Models\Business\TypeOfContract;
use App\Models\Business\UserEmployment;

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

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function supervisors()
    {
        return $this->belongsToMany(static::class, 'users_supervisors', 'user_id', 'supervisor_id')->where('active', 1);
    }

    public function subordinates()
    {
        return $this->belongsToMany(static::class, 'users_supervisors', 'supervisor_id', 'user_id')->where('active', 1);
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
        return $this->subordinates()->count() ? true:false;
    }

    public function assignSupervisors(... $supervisor_id): bool
    {
        foreach($supervisor_id as $id){
            if(!$this->isSupervisor($id)){
                $supervisor = static::find($id);
                if($supervisor){
                    $this->supervisors()->attach($supervisor);
                }
            }
        }
        return true;
    }

    public function syncSupervisors(array $supervisors_id): bool
    {
        $this->supervisors()->sync($supervisors_id);
        return true;
    }


    //MANAGER
    public function departments_manager()
    {
        return $this->hasMany(Department::class, 'manager_id');
    }

    public function isManager(): bool
    {
        return $this->departments_manager()->count() ? true:false;

    }

}
