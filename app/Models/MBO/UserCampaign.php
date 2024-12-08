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
        $status = null;
        switch ($this->stage) {
            case CampaignStage::PENDING->value:
                $status = 'bi-hourglass';
                break;

            case CampaignStage::DEFINITION->value:
            case CampaignStage::DISPOSITION->value:
                $status = 'bi-hourglass-top';
                break;

            case CampaignStage::REALIZATION->value:
            case CampaignStage::EVALUATION->value:
            case CampaignStage::SELF_EVALUATION->value:
                $status = 'bi-hourglass-split';
                break;

            default:
                $status = 'bi-hourglass-bottom';
                break;
        }

        return $status;
    }

}
