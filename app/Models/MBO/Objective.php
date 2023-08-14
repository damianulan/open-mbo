<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Enums\CampaignStage;
use App\Models\ObjectiveTemplate;
use App\Models\User;

class Objective extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'template_id',
        'parent_id',
        'user_id',
        'name',
        'description',
        'deadline',
        'goal',
        'draft',
        'of_campaign'
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'of_campaign' => 'boolean',
        'deadline' => 'datetime',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
