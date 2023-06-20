<?php

namespace App\Models\Elearning;

use App\Enums\Elearning\EnrolmentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrolment extends Model
{
    use HasFactory, UUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'type' => EnrolmentType::class,
        'timestart' => 'datetime',
        'timeend' => 'datetime',

        'self_unenrol' => 'boolean',
        'active' => 'boolean',
    ];
}
