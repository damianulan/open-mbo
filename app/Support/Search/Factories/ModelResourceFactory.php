<?php

namespace App\Support\Search\Factories;

use App\Support\Search\Discovery\SearchResourceScope;
use App\Support\Search\IndexModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModelResourceFactory
{
    public static function getResource(Model $model): ?IndexResource
    {
        $resources = (new SearchResourceScope())->get();
        foreach($resources as $resource){
            if($resource::getModelClass() === $model::class){
                return new $resource($model);
            }
        }

        return null;
    }

    public static function makeIndexes(Model $model): void
    {
        $class = $model::class;
        $resource = self::getResource($model);
        try {
            DB::beginTransaction();
            if(!$resource){
                throw new \Exception("No resource found for model [{$class}]");
            }

            if(!$model->exists){
                throw new \Exception("Model [{$class}] does not exist as a database record");
            }

            $model->indexes()->delete();

            foreach($resource->attributes() as $attribute => $value){

                if(!empty($value)){
                    $trigrams = self::getTrigrams($value);

                    foreach($trigrams as $trigram){
                        $index = new IndexModel;
                        $index->source_type = $class;
                        $index->source_id = $model->id;
                        $index->attribute = $attribute;
                        $index->trigram = self::normalizeValue($trigram);
                        if(!$index->save()){
                            throw new \Exception("Failed to save index for model [{$class}] [{$model->id}]");
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function getTrigrams(string $input): array
    {
        $input = Str::lower(trim($input));
        $length = Str::length($input);

        if ($length < 3) {
            return [];
        }

        $trigrams = [];

        for ($i = 0; $i <= $length - 3; $i++) {
            $trigrams[] = Str::substr($input, $i, 3);
        }

        return array_values(array_unique($trigrams));
    }

    private static function normalizeValue(string $value): string
    {
        return Str::lower(trim($value));
    }
}
