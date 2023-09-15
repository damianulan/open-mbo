<?php

namespace App\Facades\Logger;

use App\Facades\Logger\Activity;
use App\Facades\Logger\Log;
use App\Models\User;

trait Loggable
{
    public function activity()
    {
        return $this->hasMany(Activity::class, 'causer_id');
    }

    public function log()
    {
        if(static::class === User::class){
            return $this->hasMany(Log::class, 'causer_id');
        }
        return $this->hasMany(Log::class, 'model_id');
    }

    protected static function boot()
    {
        parent::boot();
        $user = User::find(auth()->user()->id);

        static::creating(function ($model) {
            $log = new Log();
            // getOriginal getChanges
        });
    }
}
