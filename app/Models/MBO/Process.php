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
use App\Enums\ProcessStage;

class Process extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'name',
        'period',
        'stage',
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
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'manual' => CheckboxCast::class,

        // Dates
        'available_from' => 'datetime',
        'available_to' => 'datetime',
        'disposition_from' => 'datetime',
        'disposition_to' => 'datetime',
        'realization_from' => 'datetime',
        'realization_to' => 'datetime',
        'evaluation_from' => 'datetime',
        'evaluation_to' => 'datetime',
        'self_evaluation_from' => 'datetime',
        'self_evaluation_to' => 'datetime',

        'description' => TrixFieldCast::class,
    ];
}
