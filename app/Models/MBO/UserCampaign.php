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
use App\Enums\CampaignStage;
use App\Models\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;

class UserCampaign extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'leader_id',
        'stage',
        'manual',
        'active',
    ];

    protected $casts = [
        'active' => CheckboxCast::class,
        'manual' => CheckboxCast::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function objectives()
    {
        return $this->campaign()->objectives()->where([
            'user_id' => $this->user_id,
            'draft' => 0,
            ])->get();
    }

    public function global_objectives()
    {
        return $this->campaign()->global_objectives()->where('draft', 0)->get();
    }

    public function assignObjectives()
    {
        $templates = $this->campaign()->objective_templates();
        if($templates){
            foreach($templates as $template){
                // assign objectives from template assigned to a Campaign.
            }
        }
    }

}
