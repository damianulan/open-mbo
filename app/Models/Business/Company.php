<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\Core\User;
use App\Models\Business\Location;

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

    protected $dates = [
        'founded',
        'created_at',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'founded' => 'date',
        'created_at' => 'datetime',
    ];

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class,'companies_locations');
    }

}
