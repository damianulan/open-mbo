<?php

namespace App\Support\Search\Traits;

use App\Support\Search\Factories\ModelResourceFactory;
use App\Support\Search\IndexModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasIndex
{
    protected static function bootHasIndex(): void
    {
        static::created(function (Model $model) {

        });

        static::updated(function (Model $model) {

        });

        static::deleted(function (Model $model) {

        });

        static::restored(function (Model $model) {

        });
    }

    public function indexes(): MorphMany
    {
        return $this->morphMany(IndexModel::class, 'source');
    }

    public function getSearchResource(): ?IndexResource
    {
        return ModelResourceFactory::getResource($this);
    }

    public function makeIndexes(): void
    {
        ModelResourceFactory::makeIndexes($this);
    }
}
