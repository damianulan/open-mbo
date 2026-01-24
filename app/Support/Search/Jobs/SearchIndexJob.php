<?php

namespace App\Support\Search\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SearchIndexJob implements ShouldQueueAfterCommit
{
    use Queueable;

    public function handle(Model|Collection $input)
    {
        if($input instanceof Model){
            $this->handleModel($input);
        }
        if($input instanceof Collection){
            foreach($input as $model){
                $this->handleModel($model);
            }
        }

    }

    protected function handleModel(Model $model)
    {

    }

}
