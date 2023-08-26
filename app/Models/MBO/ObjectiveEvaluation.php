<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Facades\Forms\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\MBO\Objective;
use App\Models\User;

class ObjectiveEvaluation extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms, TrixFields;

    protected $fillable = [
        'objective_id',
        'evaluation',
        'comment',
        'evaluated_by',
    ];

    protected $casts = [
        'evaluation' => 'decimal:8,2',
        'comment' => TrixFieldCast::class,
    ];

    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }

    public function evaluated_by()
    {
        return $this->belongsTo(User::class, 'evaluated_by');
    }

    public function campaign()
    {
        return $this->objective()->campaign();
    }
}
