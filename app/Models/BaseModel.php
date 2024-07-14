<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Facades\Forms\RequestForms;
use Watson\Rememberable\Rememberable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BaseModel extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms;
    //use LogsActivity;
    //use Rememberable;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->useLogName('model')
                ->logOnly($this->fillable)
                ->logOnlyDirty();
    }
}
