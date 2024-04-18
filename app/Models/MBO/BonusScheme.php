<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\Core\User;

class BonusScheme extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'description',
        'options',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'options' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_bonus_schemes');
    }

    public function assignments()
    {
        return $this->hasMany(UserBonusAssignment::class);
    }
}
