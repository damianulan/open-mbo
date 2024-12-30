<?php

namespace App\Traits\Vendors;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait ModelActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        if(!auth()->user()){
            return LogOptions::defaults();
        }
        $log_name = $this->log_name ?? 'model';

        return LogOptions::defaults()
                ->useLogName($log_name)
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
