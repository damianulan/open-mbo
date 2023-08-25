<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\User;

class UserEmployment extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [


    ];
}
