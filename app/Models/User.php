<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Facades\Forms\RequestForms;
use App\Traits\Awards;
use App\Traits\UserMBO;
use App\Traits\UserBusiness;
use App\Enums\Users\Gender;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID, HasRolesAndPermissions, SoftDeletes, RequestForms;
    use Awards, UserMBO, UserBusiness;

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
        'force_password_change'
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

}
