<?php

namespace App\View\Components\Mbo\Objectives;

use App\Models\Mbo\Objective;
use App\Models\Mbo\UserObjective;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ObjectiveSummary extends Component
{
    public $warning = 'warning';

    public function __construct(public Objective $objective, public UserObjective $userObjective)
    {
        if ($userObjective->exists && $userObjective->isPassed()) {
            $this->warning = 'passed';
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objective-summary');
    }
}
