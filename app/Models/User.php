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

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID, HasRolesAndPermissions, SoftDeletes;

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
            $this->save();
            return true;
        }

        return false;
    }

    public function unblock(): bool
    {
        if($this->active == 0){
            $this->active = 1;
            $this->save();
            return true;
        }

        return false;
    }
}
