<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Casts\CheckboxCast;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;
use App\Observers\MBO\Campaigns\UserCampaignObserver;
use App\Enums\MBO\UserObjectiveStatus;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

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
#[ObservedBy([UserCampaignObserver::class])]
class UserCampaign extends BaseModel
{
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

    protected static function boot()
    {
        parent::boot();
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
    public function setObjectiveStatus(): void
    {
        if ($this->active) {
            $sequences = CampaignStage::sequences();
            $setStage = null;
            if (in_array($this->stage, CampaignStage::sequences())) {
                if ($this->stage === CampaignStage::REALIZATION) {
                    $setStage = UserObjectiveStatus::PROGRESS;
                } elseif ($sequences[$this->stage] < $sequences[CampaignStage::REALIZATION]) {
                    $setStage = UserObjectiveStatus::UNSTARTED;
                } elseif ($sequences[$this->stage] > $sequences[CampaignStage::REALIZATION]) {
                    $setStage = UserObjectiveStatus::COMPLETED;
                }
            } else {
                $setStage = UserObjectiveStatus::INTERRUPTED;
            }

            if ($setStage) {
                $objectives = $this->objectives();
                if ($objectives->count()) {
                    foreach ($objectives as $objective) {
                        $assignments = $objective->user_assignments()->active()->whereUserId($this->user_id)->get();

                        if ($assignments->count()) {
                            foreach ($assignments as $assignment) {
                                $assignment->status = $setStage;
                                $assignment->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
