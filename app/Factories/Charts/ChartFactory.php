<?php

namespace App\Factories\Charts;

use Akaunting\Apexcharts\Chart;
use App\Factories\Charts\Exceptions\ChartNotFound;
use App\Factories\Charts\Exceptions\IncorrectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use Throwable;
use TypeError;

class ChartFactory
{
    public static function loadForModel(string $name, Model $model, array $options = []): Chart
    {
        $lib = new ModelCharts($options);
        $reflection = new ReflectionClass($lib);
        $name = Str::camel($name);

        try {
            $method = Collection::make($reflection->getMethods(ReflectionMethod::IS_PUBLIC))
                ->filter(fn ($method) => $method->getName() === $name)
                ->map(fn ($method) => $method->getName())
                ->first();

            if ( ! $method) {
                throw new ChartNotFound($name);
            }

            $chart = $lib->{$method}($model);

            return $chart;
        } catch (Throwable $th) {
            // if ($th instanceof TypeError) {
            //     $th = new IncorrectModel($name, $model);
            // }

            report($th);
            throw $th;
        }
    }
}
