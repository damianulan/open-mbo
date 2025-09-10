<?php

namespace App\View\Components\MBO\Objectives;

use App\Models\MBO\Objective;
use App\Models\MBO\UserObjective;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ObjectiveSummary extends Component
{
    public $warning = 'failed';

    /**
     * Create a new component instance.
     */
    public function __construct(public Objective $objective, public UserObjective $userObjective)
    {
        if ($userObjective->exists && $userObjective->isPassed()) {
            $this->warning = 'passed';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objective-summary');
    }
}
