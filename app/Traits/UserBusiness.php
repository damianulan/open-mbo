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
}
