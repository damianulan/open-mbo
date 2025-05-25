<?php

namespace App\Forms\MBO\Campaign;

use FormForge\Base\Form;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use Illuminate\Http\Request;

// Ajax form
class CampaignEditUserForm extends Form
{

    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj użytkowników do kampanii';
        $selected = array();
        $exclude = array();

        if ($model) {
            $user_ids = UserCampaign::where('campaign_id', $model->id)->get()->pluck('user_id');
            $coordinators = $model->coordinators->pluck('id')->toArray();

            if (!empty($user_ids)) {
                foreach ($user_ids as $tid) {
                    $selected[] = $tid;
                }
            }
            if (!empty($coordinators)) {
                foreach ($coordinators as $tid) {
                    $exclude[] = ['id' => $tid];
                }
            }
        }

        return FormBuilder::boot($request, $method, $route, 'campaign_add_users')
            ->class('campaign-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'users', $selected)->required()->label(__('forms.campaigns.users.add')))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {

        return [];
    }
}
