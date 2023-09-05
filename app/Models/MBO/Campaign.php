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
use App\Models\User;

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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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
        $diff = $now->diffInDays($end);

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
