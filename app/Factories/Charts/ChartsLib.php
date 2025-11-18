<?php

namespace App\Factories\Charts;

use Akaunting\Apexcharts\Chart;

abstract class ChartsLib
{
    protected $title;
    protected $type;

    public function __construct(private array $options = []) {}

    private function resolveOptions()
    {
        foreach ($this->options as $key => $value) {
            $this->{$key} = $value;
        }
    }

    protected function getChart(): Chart
    {
        $this->resolveOptions();
        return (new Chart())
            ->setType($this->type)
            ->setTitle($this->title);
    }
}
