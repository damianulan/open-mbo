<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use App\Casts\Carbon\CarbonDatetime;
use App\Models\MBO\UserObjective;

class Objective extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'template_id',
        'parent_id',
        'campaign_id',
        'name',
        'description',
        'deadline',
        'weight',
        'draft',
        'award',
        'expected',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'deadline' => CarbonDatetime::class,
        'description' => TrixFieldCast::class,
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function template()
    {
        return $this->belongsTo(ObjectiveTemplate::class, 'template_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function type()
    {
        return $this->template()->type;
    }

    public function user_assignments()
    {
        return $this->hasMany(UserObjective::class);
    }
}
