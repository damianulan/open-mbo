<?php

namespace App\Factories\Charts;

use Akaunting\Apexcharts\Chart;

abstract class ChartsLib
{
    protected $title;

    protected $type;

    public function __construct(private array $options = []) {}

    protected function getChart(): Chart
    {
        $this->resolveOptions();

        return (new Chart())
            ->setType($this->type)
            ->setTitle($this->title);
    }

    private function resolveOptions(): void
    {
        foreach ($this->options as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
