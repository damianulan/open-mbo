<?php

namespace App\Support\Search\Jobs;

use App\Support\Search\Traits\Searchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class SearchIndexJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public function __construct(protected Model|Collection $input) {}

    public function handle(): void
    {
        if ($this->input instanceof Model) {
            $this->handleModel($this->input);
        }
        if ($this->input instanceof Collection) {
            foreach ($this->input as $model) {
                if ($model instanceof Model) {
                    $this->handleModel($model);
                }
            }
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

    protected function handleModel(Model $model): void
    {
        $class = $model::class;
        if (class_uses_trait(Searchable::class, $class)) {
            if (class_uses_trait(SoftDeletes::class, $class) && null !== $model->deleted_at) {
                $model->purgeIndexes();
            } else {
                $model->makeIndexes();
            }
        } else {
            Log::error("Model {$class} does not use Searchable trait");
        }
    }
}
