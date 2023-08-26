<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Facades\Forms\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\MBO\Campaign;
use App\Models\MBO\ObjectiveTemplate;

/**
 * It's specifically model of template's type GLOBAL
 */
class CampaignObjective extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'campaign_id',
        'template_id',
        'name',
        'description',
        'deadline',
        'goal',
        'draft',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'deadline' => 'datetime',
        'description' => TrixFieldCast::class,
    ];

    public function template()
    {
        return $this->belongsTo(ObjectiveTemplate::class, 'template_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
