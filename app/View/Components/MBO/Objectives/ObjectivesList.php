<?php

namespace App\View\Components\MBO\Objectives;

use App\Contracts\MBO\HasObjectives;
use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use App\Traits\UserMBO;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ObjectivesList extends Component
{
    public Collection $objectives;

    public ?UserObjective $userObjective = null;

    /**
     * Create a new component instance.
     */
    public function __construct(public Model $model, public User $user = new User())
    {
        if ( ! ($model instanceof HasObjectives) && ! isset(class_uses_recursive($model)[UserMBO::class])) {
            $e = new Exception('Model must implement HasObjectives interface or UserMBO trait.');
            report($e);
            throw $e;
        }

        $this->objectives = $model->objectives;
        if ($user && $user->exists) {
            $this->userObjective = $model->user_objectives()->whereUserId($user->id)->whereNotEvaluated()->first();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objectives-list');
    }
}
