<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Facades\Forms\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\User;

class Company extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

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
