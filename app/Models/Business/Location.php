<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\Core\User;
use App\Models\Business\Company;

class Location extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'description',
        'active',
    ];

    protected $dates = [
        'created_at',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'created_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class,'companies_locations');
    }
}
