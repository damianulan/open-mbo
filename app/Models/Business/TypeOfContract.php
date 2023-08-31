<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;

class TypeOfContract extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
