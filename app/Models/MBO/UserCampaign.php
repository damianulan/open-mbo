<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Casts\CheckboxCast;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;
use App\Models\MBO\UserObjective;

/**
 * 
 *
 * @property string $id
 * @property string $campaign_id
 * @property string $user_id
 * @property string $stage
 * @property mixed $manual
 * @property mixed $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign $campaign
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withoutTrashed()
 * @mixin \Eloquent
 */
class UserCampaign extends BaseModel
{
    protected $fillable = [
        'campaign_id',
        'user_id',
        'stage',
        'manual',
        'active',
    ];

    protected $casts = [
        'active' => CheckboxCast::class,
        'manual' => CheckboxCast::class,
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $objectives = $model->campaign->objectives()->get();
            foreach($objectives as $objective){
                UserObjective::assign($model->user_id, $objective->id);
            }

            return $model;
        });

        static::updated(function ($model) {
            if($model->manual == 0 && $model->active == 1){
                $model->campaign->setUserStage($model->id);
            }
        });

        static::deleted(function ($model) {
            $objectives = $model->campaign->objectives()->get();
            foreach($objectives as $objective){
                UserObjective::unassign($model->user_id, $objective->id);
            }

            return $model;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function stageDescription()
    {
        return __('forms.campaigns.'.$this->stage);
    }

    public function stageIcon()
    {
        $status = CampaignStage::stageIcon($this->stage);

        return $status;
    }

    public function nextStage()
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $next_count = $current + 1;
        if($next_count >= count($stages)) {
            $next_count = count($stages) - 1;
        }

        $next = CampaignStage::getBySequence($next_count);
        $this->stage = $next;

        return $this->update();
    }

    public function previousStage()
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $prev_count = $current - 1;
        if($prev_count <= 0) {
            $prev_count = 0;
        }

        $prev = CampaignStage::getBySequence($prev_count);
        $this->stage = $prev;

        return $this->update();
    }

    public function toggleManual()
    {
        $this->manual = $this->manual ? 0:1;
        $this->stage = $this->campaign->setUserStage();
        return $this->update();
    }


}
