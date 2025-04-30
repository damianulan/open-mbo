<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;
use App\Casts\CheckboxCast;
use Illuminate\Support\Collection;
use App\Models\MBO\Objective;
use App\Models\MBO\UserCampaign;
use Carbon\Carbon;
use App\Models\Core\User;
use App\Enums\MBO\CampaignStage;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $period
 * @property mixed|null $description
 * @property mixed $definition_from
 * @property mixed $definition_to
 * @property mixed $disposition_from
 * @property mixed $disposition_to
 * @property mixed $realization_from
 * @property mixed $realization_to
 * @property mixed $evaluation_from
 * @property mixed $evaluation_to
 * @property mixed $self_evaluation_from
 * @property mixed $self_evaluation_to
 * @property mixed $draft
 * @property mixed $manual
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserCampaign> $user_campaigns
 * @property-read int|null $user_campaigns_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withoutTrashed()
 * @property string $stage
 * @mixin \Eloquent
 */
class Campaign extends BaseModel
{
    public $stages;
    public $timestamps = true;
    protected $log_name = 'mbo';

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
        'stage', // current overall CampaignStage

        'draft',
        'manual',
        'created_by',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'manual' => CheckboxCast::class,

        // Dates
        // 'definition_from' => CarbonDatetime::class,
        // 'definition_to' => CarbonDatetime::class,
        // 'disposition_from' => CarbonDatetime::class,
        // 'disposition_to' => CarbonDatetime::class,
        // 'realization_from' => CarbonDatetime::class,
        // 'realization_to' => CarbonDatetime::class,
        // 'evaluation_from' => CarbonDatetime::class,
        // 'evaluation_to' => CarbonDatetime::class,
        // 'self_evaluation_from' => CarbonDatetime::class,
        // 'self_evaluation_to' => CarbonDatetime::class,
        'description' => TrixFieldCast::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->manual == 0) {
                $model->setStageAuto();
            } else {
                $model->stage = CampaignStage::PENDING;
            }

            return $model;
        });

        static::updating(function ($model) {
            if ($model->manual == 0) {
                $model->setStageAuto();
            } else {
                $model->stage = CampaignStage::PENDING;
            }

            return $model;
        });
    }

    public function user_campaigns()
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function coordinators()
    {
        return $this->morphToMany(User::class, 'context', 'users_roles');
    }

    public function refreshCoordinators(?array $user_ids)
    {
        if (!$user_ids) {
            $user_ids = array();
        }

        $current = $this->coordinators->pluck('id')->toArray();
        $toDelete = array_filter($current, function ($value) use ($user_ids) {
            return !in_array($value, $user_ids);
        });
        $toAdd = array_filter($user_ids, function ($value) use ($current) {
            return !in_array($value, $current);
        });

        foreach ($toDelete as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->revokeRole('campaign_coordinator', $this);
            }
        }
        foreach ($toAdd as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->assignRole('campaign_coordinator', $this);
            }
        }

        return true;
    }

    public function assignUser($user_id)
    {
        $exists = $this->user_campaigns()->where('user_id', $user_id)->exists();
        if (!$exists) {
            $this->user_campaigns()->create([
                'user_id' => $user_id,
                'stage' => $this->setUserStage($user_id),
                'manual' => $this->manual,
                'active' => $this->draft ? 0 : 1,
            ]);
        }
        return true;
    }

    public function unassignUser($user_id)
    {
        $record = $this->user_campaigns()->where('user_id', $user_id)->first();
        if ($record) {
            $record->delete();
        }
        return true;
    }

    public function setUserStage($enrol_id = null)
    {
        $params = ['manual' => 0, 'active' => 1];
        if ($enrol_id) {
            $params['id'] = $enrol_id;
        }
        $enrols = $this->user_campaigns()->where($params)->get();
        $stage =  $this->getCurrentStages()->first();
        if (!empty($enrols)) {
            foreach ($enrols as $enrol) {
                $enrol->timestamps = false;
                $enrol->stage = $stage;
                $enrol->update();
            }
        }
        return $stage;
    }

    public function setStageAuto()
    {
        $stage = CampaignStage::PENDING;
        $now = Carbon::now();

        foreach (CampaignStage::softValues() as $tmp) {
            $prop_start = $tmp . '_from';
            $prop_end = $tmp . '_to';
            $start = Carbon::parse($this->$prop_start);
            $end = Carbon::parse($this->$prop_end);

            if ($now->between($start, $end)) {
                $stage = CampaignStage::IN_PROGRESS;
                break;
            }
        }

        $this->stage = $stage;

        return $this;
    }

    public function getCurrentStages(): Collection
    {
        $stages = new Collection();
        $now = Carbon::now();

        if ($this->stage === CampaignStage::IN_PROGRESS) {
            foreach (CampaignStage::softValues() as $tmp) {
                $prop_start = $tmp . '_from';
                $prop_end = $tmp . '_to';
                $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->$prop_start);
                $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->$prop_end);

                if ($now->between($start, $end)) {
                    $stages->push($tmp);
                }
            }
        } else {
            $stages->push($this->stage);
        }

        return $stages;
    }

    public function active(): bool
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $now->between($start, $end) && !$this->draft;
    }

    public function finished(): bool
    {
        if ($this->manual) {
            return false;
        }

        $now = Carbon::now();
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $now->greaterThan($end) && !$this->manual;
    }


    public function getProgress(): int
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        if ($now >= $start) {
            $fullDiff = $start->diffInDays($end, false);
            $diff = abs($now->diffInDays($start));
            $progress = round(($diff / $fullDiff) * 100);
        } else {
            $progress = 0;
        }

        return $progress;
    }

    public function dateStart(): string
    {
        return $this->definition_from;
    }
    public function dateEnd(): string
    {
        return $this->self_evaluation_to;
    }

    public function dateStartView(): string
    {
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        return $start->format(config('app.date_format'));
    }
    public function dateEndView(): string
    {
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $end->format(config('app.date_format'));
    }

    public function getSoftStages(): array
    {
        return CampaignStage::softValues();
    }

    public function getStageIcon(string $stage): ?string
    {
        return CampaignStage::stageIcon($stage);
    }

    public function getStageName(string $stage): ?string
    {
        return CampaignStage::getName($stage);
    }

    public function getStageInfo(string $stage): ?string
    {
        return CampaignStage::getInfo($stage);
    }
}
