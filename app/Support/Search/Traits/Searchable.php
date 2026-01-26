<?php

namespace App\Support\Search\Traits;

use App\Support\Search\Factories\ModelResourceFactory;
use App\Support\Search\IndexModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Support\Search\Jobs\SearchIndexJob;
use App\Support\Search\Factories\IndexResource;

trait Searchable
{
    protected static function bootSearchable(): void
    {
        static::created(function (Model $model) {
            SearchIndexJob::dispatch($model);
        });

        static::updated(function (Model $model) {
            $resource = $model->getSearchResource();
            if($resource){
                if(array_intersect(array_keys($resource->attributes()), array_keys($model->getDirty()))){
                    SearchIndexJob::dispatch($model)->delay(60);
                }
            }
        });

        static::deleted(function (Model $model) {
            SearchIndexJob::dispatch($model)->delay(60);
        });

        static::restored(function (Model $model) {
            SearchIndexJob::dispatch($model);
        });
    }

    public function indexes(): MorphMany
    {
        return $this->morphMany(IndexModel::class, 'source');
    }

    public function search(string $input): MorphMany
    {
        return $this->indexes()->search($input);
    }

    public function getSearchResource(): ?IndexResource
    {
        return ModelResourceFactory::getResource($this);
    }

    public function makeIndexes(): void
    {
        ModelResourceFactory::makeIndexes($this);
    }

    public function purgeIndexes(): void
    {
        ModelResourceFactory::purgeIndexes($this);
    }
}
