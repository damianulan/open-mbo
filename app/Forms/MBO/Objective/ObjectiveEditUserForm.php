<?php

namespace App\Forms\MBO\Objective;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

// Ajax form
class ObjectiveEditUserForm extends Form
{
    public function definition(): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj użytkowników do realizacji celu';
        $selected = array();
        $exclude = array();

        if ($this->model) {
            $user_ids = UserObjective::where('objective_id', $this->model->id)->get()->pluck('user_id');

            if ( ! empty($user_ids)) {
                foreach ($user_ids as $tid) {
                    $selected[] = $tid;
                }
            }
        }

        return FormBuilder::boot($method, $route, 'objective_add_users')
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::multiselect('user_ids', $this->model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'users', $selected)->required()->label(__('forms.mbo.objectives.users.add')))
            ->addTitle($title);
    }

    public function validation(): array
    {

        return array();
    }
}
