<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use Mews\Purifier\Casts\CleanHtmlOutput;

class CourseCategory extends Model
{
    use HasFactory, UUID, SoftDeletes, TrixFields;

    protected $fillable = [
        'title',
        'description',
        'public',
        'visible',
    ];

    protected $casts = [
        'public' => 'boolean',
        'visible' => 'boolean',

        'description' => CleanHtmlOutput::class,
    ];

    protected $trixFields = [
        'description',
    ];

    public static function getPublic()
    {
        return self::where(['visible' => 1, 'public' => 1])->get();
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
