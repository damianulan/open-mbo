<?php

namespace App\Traits\Vendors;

use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

trait ModelActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        if (! Auth::check()) {
            return LogOptions::defaults();
        }
        $log_name = $this->log_name ?? 'model';

        return LogOptions::defaults()
            ->useLogName($log_name)
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->setDescriptionForEvent(fn (string $eventName) => __('logging.description.' . $eventName, [
                'username' => Auth::user()->name,
                'model_map' => __('logging.model_mapping.' . static::class),
            ]));
    }
}
