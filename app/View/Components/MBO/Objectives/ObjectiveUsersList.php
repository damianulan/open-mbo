<?php

namespace App\View\Components\MBO\Objectives;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MBO\Objective;

class ObjectiveUsersList extends Component
{
    public $emptyInfo;
    public $userAssignments;

    /**
     * Create a new component instance.
     */
    public function __construct(public Objective $objective, public string $status = 'all')
    {
        $this->emptyInfo = __('mbo.info.no_users_added');
        if ($status === 'all') {
            $this->userAssignments = $objective->user_assignments()->get();
        } elseif ($status === 'progress') {
            $this->userAssignments = $objective->user_assignments()->whereNotEvaluated()->get();
            $this->emptyInfo = __('mbo.info.objective_not_evaluated_no_users');
        } elseif ($status === 'passed') {
            $this->userAssignments = $objective->user_assignments()->wherePassed()->get();
            $this->emptyInfo = __('mbo.info.objective_passed_no_users');
        } elseif ($status === 'failed') {
            $this->userAssignments = $objective->user_assignments()->whereFailed()->get();
            $this->emptyInfo = __('mbo.info.objective_failed_no_users');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objective-users-list');
    }
}
