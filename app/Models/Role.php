<?php

namespace App\Models;

use App\Models\BaseModel;

class Role extends BaseModel
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }
}
