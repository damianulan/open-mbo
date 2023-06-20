<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;

class Course extends Model
{
    use HasFactory, UUID, SoftDeletes, TrixFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'available_from',
        'available_to',
        'public',
        'active',
        'visible',
        'picture'
    ];

    protected $casts = [
        'public' => 'boolean',
        'active' => 'boolean',
        'visible' => 'boolean',

        // Dates
        'available_from' => 'datetime',
        'available_to' => 'datetime',
    ];

    protected $trixFields = [
        'description',
    ];

    public static function getCatalog()
    {
        return self::where(['public' => 1, 'visible' => 1, 'active' => 1])->get();
    }
}
