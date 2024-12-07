<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use Illuminate\Support\Collection;
use App\Models\MBO\Objective;
use App\Models\MBO\CampaignObjective;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\ObjectiveTemplate;
use App\Casts\Carbon\CarbonDate;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
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
 * @mixin \Eloquent
 */
class Campaign extends BaseModel
{
    use TrixFields;

    public $stages;

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
        'stage', // current CampaignStage

        'draft',
        'manual',
        'created_by',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'manual' => CheckboxCast::class,

        // Dates
        'definition_from' => CarbonDate::class,
        'definition_to' => CarbonDate::class,
        'disposition_from' => CarbonDate::class,
        'disposition_to' => CarbonDate::class,
        'realization_from' => CarbonDate::class,
        'realization_to' => CarbonDate::class,
        'evaluation_from' => CarbonDate::class,
        'evaluation_to' => CarbonDate::class,
        'self_evaluation_from' => CarbonDate::class,
        'self_evaluation_to' => CarbonDate::class,
        'stage' => CampaignStage::class,

        'description' => TrixFieldCast::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('mbo');
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
        return $this->belongsToMany(User::class, 'campaigns_coordinators', 'campaign_id', 'coordinator_id')->where('active', 1);
    }

    public function assignUser($user_id)
    {
        $exists = $this->user_campaigns()->where('user_id', $user_id)->exists();
        if(!$exists){
            $this->user_campaigns()->create([
                'user_id' => $user_id,
                'stage' => $this->setUserStage($user_id),
                'manual' => $this->manual,
                'active' => $this->draft ? 0:1,
            ]);
        }
        return true;
    }

    public function active(): bool
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.date_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.date_format'), $this->dateEnd());
        return $now->between($start, $end) && !$this->draft;
    }

    public function finished(): bool
    {
        if($this->manual){
            return false;
        }

        $now = Carbon::now();
        $end = Carbon::createFromFormat(config('app.date_format'), $this->dateEnd());
        return $now->greaterThan($end) && !$this->manual;
    }

    public function stages(): Collection
    {
        $stages = new Collection();

        return $stages;
    }

    public function getProgress(): int
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.date_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.date_format'), $this->dateEnd());
        $fullDiff = $start->diffInDays($end, false);
        $diff = abs($now->diffInDays($start));

        return round(($diff / $fullDiff)*100);
    }

    public function dateStart(): string
    {
        return $this->definition_from;
    }
    public function dateEnd(): string
    {
        return $this->self_evaluation_to;
    }
}
