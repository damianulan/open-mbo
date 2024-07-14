<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\Core\User;

class Company extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'shortname',
        'description',
        'logo',
        'founded',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'founded' => 'date',
    ];

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
