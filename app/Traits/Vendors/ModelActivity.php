<?php

namespace App\Traits\Vendors;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait ModelActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->useLogName('model')
                ->logOnly($this->fillable)
                ->logOnlyDirty()
                ->dontSubmitEmptyLogs()
                ->setDescriptionForEvent(function(string $eventName) {
                    return __('logging.description.'.$eventName, [
                        'username' => auth()->user()->name(),
                        'model_map' => __('logging.model_mapping.'.static::class),
                    ]);
                });
    }



}
