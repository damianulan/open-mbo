<?php

namespace App\Models\Elearning;

use App\Casts\CheckboxCast;
use App\Facades\Forms\Elements\Checkbox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Lib\Theme;

class Course extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
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
        'public' => CheckboxCast::class,
        'active' => CheckboxCast::class,
        'visible' => CheckboxCast::class,

        // Dates
        'available_from' => 'datetime',
        'available_to' => 'datetime',

        'description' => TrixFieldCast::class,
    ];

    protected $storagePath = 'pictures/courses';

    public static function getCatalog()
    {
        return self::where(['public' => 1, 'visible' => 1, 'active' => 1])->get();
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function loadPicture()
    {
        return $this->picture ? asset("storage/$this->picture"):asset(Theme::imagePath()."courses/course-default-pic.jpg");
    }


}
