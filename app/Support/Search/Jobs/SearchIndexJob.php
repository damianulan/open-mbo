<?php

namespace App\Support\Search\Jobs;

use App\Support\Search\Traits\Searchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class SearchIndexJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public function __construct(protected Model|Collection $input){}

    public function handle()
    {
        if($this->input instanceof Model){
            $this->handleModel($this->input);
        }
        if($this->input instanceof Collection){
            foreach($this->input as $model){
                if($model instanceof Model){
                    $this->handleModel($model);
                }
            }
        }
    }

    protected function handleModel(Model $model)
    {
        $class = $model::class;
        if(class_uses_trait(Searchable::class, $class)){
            if(class_uses_trait(SoftDeletes::class, $class) && $model->deleted_at !== null){
                $model->purgeIndexes();
            }
            else {
                $model->makeIndexes();
            }
        } else {
            Log::error("Model {$class} does not use Searchable trait");
        }
    }

    public function retryUntil()
    {
        return now()->addMinutes(5);
    }

    public function backoff(): array
    {
        return [1, 3, 5];
    }

}
