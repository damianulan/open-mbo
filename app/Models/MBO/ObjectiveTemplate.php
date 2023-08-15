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
use App\Models\MBO\Objective;
use App\Models\MBO\CampaignObjective;
use App\Models\MBO\ObjectiveTemplateCategory;

class ObjectiveTemplate extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'goal',
        'type',
        'draft',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'description' => TrixFieldCast::class,
    ];

    public function category()
    {
        return $this->belongsTo(ObjectiveTemplateCategory::class, 'category_id');
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'template_id');
    }

    public function global_objectives()
    {
        return $this->hasMany(CampaignObjective::class, 'template_id');
    }
}
