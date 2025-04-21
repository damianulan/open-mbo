<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;

/**
 *
 * @property string $id
 * @property string $user_id
 * @property string $bonus_scheme_id
 * @property string $campaign_id
 * @property int $score
 * @property User $approved_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read BonusScheme $bonus_scheme
 * @property-read Campaign $campaign
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereBonusSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withoutTrashed()
 * @mixin \Eloquent
 */
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
