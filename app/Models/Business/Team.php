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

class Team extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

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
