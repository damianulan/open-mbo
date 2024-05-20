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
use App\Models\MBO\ObjectiveTemplate;

class ObjectiveTemplateCategory extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'global',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'global' => CheckboxCast::class,
    ];

    public function objective_templates()
    {
        return $this->hasMany(ObjectiveTemplate::class, 'category_id');
    }
}
