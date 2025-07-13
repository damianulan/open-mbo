<?php

namespace App\Models;

use App\Traits\Vendors\ModelActivity;
use Carbon\Carbon;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lucent\Support\Traits\Accessible;
use Lucent\Support\Traits\UUID;
use Lucent\Support\Traits\VirginModel;
use Watson\Rememberable\Rememberable;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel published()
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use Accessible, ModelActivity, VirginModel;
    use HasFactory, RequestForms, SoftDeletes, UUID;
    // use Rememberable;

    public function carbonDate(string $prop, string $format = 'Y-m-d')
    {
        $date = $this->$prop;
        $date_carbon = null;
        if ($date) {
            $date_carbon = Carbon::parse($date)->format($format);
        }

        return $date_carbon;
    }
}
