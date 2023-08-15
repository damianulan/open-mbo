<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Traits\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\MBO\ObjectiveTemplate;

class ObjectiveTemplateCategory extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public function objective_templates()
    {
        return $this->hasMany(ObjectiveTemplate::class, 'category_id');
    }
}
