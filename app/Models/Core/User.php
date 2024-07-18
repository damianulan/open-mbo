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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use UUID, HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes, RequestForms;
    use UserMBO, UserBusiness, ActiveFields, Impersonate, Impersonable;

    protected $fillable = [
        'email',
        'active',
        'core',
        'force_password_change',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $activeRules = [
        'active' => 1,
        'core' => 0,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected static function booted() {
        static::deleting(function(User $user) {
            $user->profile->delete();
       });
    }

    public function generatePassword()
    {
        $this->password = Hash::make(Str::random(10));
        return $this;
    }

    public function name(): string
    {
        return $this->profile->firstname . ' ' . $this->profile->lastname;
    }

    public function firstname() : string
    {
        return $this->profile->firstname;
    }

    public function lastname(): string
    {
        return $this->profile->lastname;
    }

    public function toggleLock(): bool
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
        return $this->active ? false:true;
    }

    public function canBeDeleted(): bool
    {
        return $this->core==0||isRoot() ? true:false;
    }

    public function canBeSuspended(): bool
    {
        return $this->core==0||isRoot() ? true:false;
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
        return !$this->hasAnyRole('root', 'support')||isRoot();
    }

    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

}
