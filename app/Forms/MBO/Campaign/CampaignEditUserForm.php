<?php

namespace App\Forms\MBO\Campaign;

use FormForge\Base\Form;
use FormForge\Contracts\FormIO;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use Illuminate\Http\Request;

// Ajax form
class CampaignEditUserForm extends Form implements FormIO
{

    /**
     * @param  App\Models\MBO\Campaign  $model
     * @param  Request|null             $request
     * @return FormBuilder
     */
    public static function definition($model = null, ?Request $request = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj użytkowników do kampanii';
        $user_ids = UserCampaign::where('campaign_id', $model->id)->get()->pluck('user_id');
        $coordinators = $model->coordinators->pluck('id')->toArray();
        $selected = array();
        $exclude = array();
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

        return FormBuilder::boot($method, $route, 'campaign_add_users')
            ->class('campaign-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'users', $selected)->required()->label(__('forms.campaigns.users.add')))
            ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {

        return [];
    }
}
