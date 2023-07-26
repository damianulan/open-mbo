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
use App\Traits\RequestForms;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID, HasRolesAndPermissions, SoftDeletes, RequestForms;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime'
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

}
