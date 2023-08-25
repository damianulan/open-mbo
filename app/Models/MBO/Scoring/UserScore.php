<?php

namespace App\Models\MBO\Scoring;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\User;

class UserScore extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'user_id',
        'score',
    ];
}
