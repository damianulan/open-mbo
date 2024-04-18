<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Facades\Forms\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Models\MBO\CampaignObjective;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Enums\ObjectiveType;

class ObjectiveTemplate extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'goal',
        'type',
        'draft',
        'award',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'description' => TrixFieldCast::class,
        'type' => ObjectiveType::class,
    ];

    public function category()
    {
        return $this->belongsTo(ObjectiveTemplateCategory::class, 'category_id');
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'template_id');
    }

    public function users_count()
    {
        return $this->objectives()->count();
    }

    public function global_objectives()
    {
        return $this->hasMany(CampaignObjective::class, 'template_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'objective_templates_campaigns');
    }

    public function global(): bool
    {
        return $this->category()->global ? true:false;
    }

    public function assign(User $user): bool
    {
        $objective = new Objective();
        $objective->template_id = $this->id;
        $objective->user_id = $user->id;
        $objective->name = $this->name;
        $objective->description = $this->description;
        $objective->goal = $this->goal;
        $objective->draft = 1;
        $objective->award = $this->award;
        return $objective->save();
    }
}
