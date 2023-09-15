<?php

namespace App\Models;

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
use App\Traits\Awards;
use App\Traits\UserMBO;
use App\Traits\UserBusiness;
use App\Traits\ActiveFields;
use App\Enums\Users\Gender;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID, HasRolesAndPermissions, SoftDeletes, RequestForms;
    use Awards, UserMBO, UserBusiness, ActiveFields, Impersonate, Impersonable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'email',
        'password',
        'phone',
        'avatar',
        'active',
        'force_password_change',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'birthday',
    ];

    protected $activeRules = [
        'active' => 1,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'gender' => Gender::class,
    ];

    public function name()
    {
        return $this->firstname . ' ' . $this->lastname;
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
        if($this->avatar){
            return asset($this->avatar);
        }
        if($this->gender->name === 'MALE'){
            return asset('images/portrait/avatar-male.png');
        } elseif($this->gender->name === 'FEMALE'){
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

}
