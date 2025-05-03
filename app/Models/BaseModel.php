<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use FormForge\Traits\RequestForms;
use Watson\Rememberable\Rememberable;
use App\Traits\Vendors\ModelActivity;
use App\Traits\VirginModel;
use Carbon\Carbon;
use App\Traits\Accessible;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms;
    use ModelActivity, VirginModel, Accessible;
    //use Rememberable;

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
