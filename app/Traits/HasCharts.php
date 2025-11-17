<?php

namespace App\Traits;

use Akaunting\Apexcharts\Chart;
use App\Factories\Charts\ChartFactory;

trait HasCharts
{
    public function chart(string $name, array $options = []): ?Chart
    {
        return ChartFactory::loadForModel($name, $this, $options);
    }
}
