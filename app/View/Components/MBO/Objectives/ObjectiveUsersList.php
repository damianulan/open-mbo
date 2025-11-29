<?php

namespace App\View\Components\MBO\Objectives;

use App\Models\MBO\Objective;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ObjectiveUsersList extends Component
{
    public $emptyInfo;

    public $userAssignments;

    /**
     * Create a new component instance.
     * @param Objective $objective
     * @param string $status
     */
    public function __construct(public Objective $objective, public string $status = 'all')
    {
        $this->emptyInfo = __('mbo.info.no_users_added');
        if ('all' === $status) {
            $this->userAssignments = $objective->user_objectives()->get();
        } elseif ('progress' === $status) {
            $this->userAssignments = $objective->user_objectives()->whereNotEvaluated()->get();
            $this->emptyInfo = __('mbo.info.objective_not_evaluated_no_users');
        } elseif ('passed' === $status) {
            $this->userAssignments = $objective->user_objectives()->wherePassed()->get();
            $this->emptyInfo = __('mbo.info.objective_passed_no_users');
        } elseif ('failed' === $status) {
            $this->userAssignments = $objective->user_objectives()->whereFailed()->get();
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
