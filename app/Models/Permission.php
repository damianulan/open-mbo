<?php

namespace App\Models;

use App\Models\BaseModel;

class Permission extends BaseModel
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
