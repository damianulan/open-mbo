<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, UUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'available_from',
        'available_to',
        'active',
        'visible',
        'picture'
    ];

    protected $casts = [
        'active' => 'boolean',
        'visible' => 'boolean',
    ];

    protected $dates = [
        'available_from', 'available_to'
    ];
}
