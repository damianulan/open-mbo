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
use Illuminate\Support\Collection;
use App\Enums\CampaignStage;
use App\Models\MBO\Objective;
use App\Models\MBO\CampaignObjective;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\ObjectiveTemplate;

class Campaign extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    public $stages;

    public function __construct()
    {
        $this->stages = $this->stages();
    }

    protected $fillable = [
        'name',
        'period',
        'description',

        'definition_from',
        'definition_to',
        'disposition_from',
        'disposition_to',
        'realization_from',
        'realization_to',
        'evaluation_from',
        'evaluation_to',
        'self_evaluation_from',
        'self_evaluation_to',

        'draft',
        'manual',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'manual' => CheckboxCast::class,

        // Dates
        'definition_from' => 'datetime',
        'definition_to' => 'datetime',
        'disposition_from' => 'datetime',
        'disposition_to' => 'datetime',
        'realization_from' => 'datetime',
        'realization_to' => 'datetime',
        'evaluation_from' => 'datetime',
        'evaluation_to' => 'datetime',
        'self_evaluation_from' => 'datetime',
        'self_evaluation_to' => 'datetime',

        'description' => TrixFieldCast::class,
    ];

    public function user_campaigns()
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function objective_templates()
    {
        return $this->belongsToMany(ObjectiveTemplate::class, 'objective_templates_campaigns');
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function global_objectives()
    {
        return $this->hasMany(CampaignObjective::class);
    }

    public function stages(): Collection
    {
        $stages = new Collection;

        return $stages;
    }
}
