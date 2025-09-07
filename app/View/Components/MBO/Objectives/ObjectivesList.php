<?php

namespace App\View\Components\MBO\Objectives;

use App\Contracts\MBO\HasObjectives;
use App\Traits\UserMBO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ObjectivesList extends Component
{
    public Collection $objectives;

    /**
     * Create a new component instance.
     */
    public function __construct(public Model $model)
    {
        if (! ($model instanceof HasObjectives) && ! isset(class_uses_recursive($model)[UserMBO::class])) {
            $e = new \Exception('Model must implement HasObjectives interface or UserMBO trait.');
            report($e);
            throw $e;
        }

        $this->objectives = $model->objectives;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objectives-list');
    }
}
