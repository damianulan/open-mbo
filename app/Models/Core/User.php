<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Lab404\Impersonate\Models\Impersonate;
use App\Traits\Impersonable;
use App\Traits\HasRolesAndPermissions;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Facades\Forms\RequestForms;
use App\Traits\UserMBO;
use App\Traits\UserBusiness;
use App\Traits\ActiveFields;
use App\Models\Core\UserProfile;

class User extends Authenticatable
{
    use UUID, HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes, RequestForms;
    use UserMBO, UserBusiness, ActiveFields, Impersonate, Impersonable;

    protected $fillable = [
        'email',
        'active',
        'force_password_change',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $activeRules = [
        'active' => 1,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function name()
    {
        return $this->profile->firstname . ' ' . $this->profile->lastname;
    }

    public function block(): bool
    {
        if($this->active == 1){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
        if($this->update()){
            return true;
        }

        return false;
    }

    public function blocked(): bool
    {
        return $this->active ? true:false;
    }

    public function getAvatar(): ?string
    {
        if($this->profile->avatar){
            return asset($this->profile->avatar);
        }
        if($this->profile->gender->name === 'MALE'){
            return asset('images/portrait/avatar-male.png');
        } elseif($this->profile->gender->name === 'FEMALE'){
            return asset('images/portrait/avatar-female.png');
        }
        return null;
    }

    public function canBeImpersonated(): bool
    {
        return !$this->hasRole('root');
    }

    public function canImpersonate(): bool
    {
        return $this->hasRole('root');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

}
