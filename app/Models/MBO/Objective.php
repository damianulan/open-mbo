<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Campaign;
use App\Models\User;
use App\Casts\Carbon\CarbonDatetime;

class Objective extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'template_id',
        'parent_id',
        'user_id',
        'campaign_id',
        'name',
        'description',
        'deadline',
        'goal',
        'weight',
        'draft',
        'award',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'deadline' => CarbonDatetime::class,
        'description' => TrixFieldCast::class,
        'goal' => 'decimal:8,2',
        'weight' => 'decimal:2,2',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function type()
    {
        return $this->template()->type;
    }
}
