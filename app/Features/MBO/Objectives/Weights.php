<?php

namespace App\Features\MBO\Objectives;

use FeatureKit\Factories\Feature;

class Weights extends Feature
{
    public function define(): bool
    {
        return false;
    }

    public function key(): string
    {
        return 'objectives.weights';
    }
}
