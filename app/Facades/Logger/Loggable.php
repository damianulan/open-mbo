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

    public function logs()
    {
        if(static::class === User::class){
            return $this->hasMany(Log::class, 'causer_id');
        }
        return $this->hasMany(Log::class, 'model_id');
    }

    protected static function bootLoggable()
    {
        static::updated(function ($model) {
            $original = $model->getOriginal();
            $dirty = $model->getChanges();

            $changes = array();
            $unlistedFields = [
                'created_at', 'updated_at', 'deleted_at'
            ];

            if(!empty($dirty)){
                foreach($dirty as $field => $value){
                    if(!in_array($field, $unlistedFields)){
                        $changes[$field]['clean'] = $original[$field];
                        $changes[$field]['dirty'] = $value;
                    }
                }
            }

            $log = new Log();
            $log->causer_id = auth()->user()->id;
            $log->model_id = $model->id;
            $log->model = $model::class;
            $log->action = 'update';
            if(!empty($changes)){
                $log->changes = $changes;
            }
            $log->ip_address = request()->ip();
            $log->save();
        });
    }
}
