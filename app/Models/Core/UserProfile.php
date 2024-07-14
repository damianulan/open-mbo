<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Users\Gender;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Core\User;

class UserProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'phone',
        'avatar',
    ];

    protected $dates = [
        'birthday',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'gender' => Gender::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
