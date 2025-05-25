<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Casts\CheckboxCast;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;
use App\Enums\MBO\UserObjectiveStatus;
use App\Models\MBO\UserObjective;
use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use Lucent\Support\Traits\Dispatcher;
use App\Events\MBO\Campaigns\UserCampaignUpdated;

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
    use Dispatcher;

    public $logEntities = ['user_id' => User::class, 'campaign_id' => Campaign::class];

    protected $fillable = [
        'campaign_id',
        'user_id',
        'stage',
        'manual',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'manual' => 'boolean',
    ];


    public $timestamps = true;

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
        return $this->campaign->objectives()->whereAssigned($this->user)->get();
    }

    public function assignObjectives()
    {
        $templates = $this->campaign->objective_templates();
        if ($templates) {
            foreach ($templates as $template) {
                // TODO assign objectives from template assigned to a Campaign.
            }
        }
    }

    public function stageDescription(): string
    {
        return __('forms.campaigns.' . $this->stage);
    }

    public function stageIcon(): string
    {
        $status = CampaignStage::stageIcon($this->stage);

        return $status;
    }

    public function terminate(): bool
    {
        if ($this->stage !== CampaignStage::TERMINATED) {
            $this->stage = CampaignStage::TERMINATED;
            return $this->update();
        }
        return false;
    }

    public function resume(): bool
    {
        $this->stage = CampaignStage::IN_PROGRESS;
        return $this->update();
    }

    public function cancel(): bool
    {
        if ($this->stage !== CampaignStage::CANCELED) {
            $this->stage = CampaignStage::CANCELED;
            return $this->update();
        }
        return false;
    }



    public function nextStage(): bool
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $next_count = $current + 1;
        if ($next_count >= count($stages)) {
            $next_count = count($stages) - 1;
        }

        $next = CampaignStage::getBySequence($next_count);
        $this->stage = $next;

        return $this->update();
    }

    public function previousStage(): bool
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $prev_count = $current - 1;
        if ($prev_count <= 0) {
            $prev_count = 0;
        }

        $prev = CampaignStage::getBySequence($prev_count);
        $this->stage = $prev;

        return $this->update();
    }

    public function toggleManual(): bool
    {
        $this->manual = $this->manual ? 0 : 1;
        $this->stage = $this->campaign->setUserStage();
        return $this->update();
    }

    public function isManual(): bool
    {
        return $this->manual || $this->campaign?->manual;
    }

    /**
     * Sets users' objectives statuses based on campaign stage changes.
     *
     * @return void
     */
    public function mapObjectiveStatus(): void
    {
        $objectives = $this->objectives();
        if ($objectives->count()) {
            foreach ($objectives as $objective) {
                $assignments = $objective->user_assignments()->whereUserId($this->user_id)->get();

                if ($assignments->count()) {
                    foreach ($assignments as $assignment) {
                        $assignment->setStatus()->update();
                    }
                }
            }
        }
    }

    public static function createdUserCampaign(UserCampaign $model): void
    {
        $objectives = $model->campaign->objectives()->get();
        foreach ($objectives as $objective) {
            UserObjective::assign($model->user_id, $objective->id);
        }

        UserCampaignAssigned::dispatch($model->user, $model->campaign);
    }

    /**
     * Handle the UserCampaign "updated" event.
     */
    public static function updatedUserCampaign(UserCampaign $model): void
    {
        $model->mapObjectiveStatus();
        UserCampaignUpdated::dispatch($model);
    }

    /**
     * Handle the UserCampaign "deleted" event.
     */
    public static function deletedUserCampaign(UserCampaign $model): void
    {
        $objectives = $model->campaign->objectives()->get();
        foreach ($objectives as $objective) {
            UserObjective::unassign($model->user_id, $objective->id);
        }

        UserCampaignUnassigned::dispatch($model->user, $model->campaign);
    }
}
