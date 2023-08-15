<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\User;

class BonusScheme extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

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
