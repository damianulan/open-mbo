<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;

class UserBonusAssignment extends BaseModel
{

    protected $fillable = [
        'user_id',
        'bonus_scheme_id',
        'campaign_id',
        'score',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function bonus_scheme()
    {
        return $this->belongsTo(BonusScheme::class);
    }
}
