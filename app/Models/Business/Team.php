<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\User;

class Team extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'leader_id',
        'name',
        'description',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_teams');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
