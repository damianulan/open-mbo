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
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj użytkowników do realizacji celu';
        $selected = [];
        $exclude = [];

        if ($model) {
            $user_ids = UserObjective::where('objective_id', $model->id)->get()->pluck('user_id');

            if ( ! empty($user_ids)) {
                foreach ($user_ids as $tid) {
                    $selected[] = $tid;
                }
            }
        }

        return FormBuilder::boot($request, $method, $route, 'objective_add_users')
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'users', $selected)->required()->label(__('forms.mbo.objectives.users.add')))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {

        return [];
    }
}
