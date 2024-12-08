<?php

namespace App\Forms\MBO\Campaign;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Enums\MBO\CampaignStage;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Objective;
use App\Models\MBO\UserCampaign;
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
    public static function boot($model = null, ?Request $request = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj użytkowników do kampanii';
        $user_ids = UserCampaign::where('campaign_id', $model->id)->get()->pluck('user_id');
        $exclude = array();
        if(!empty($user_ids)){
            foreach($user_ids as $tid){
                $exclude[] = $tid;
            }
        }

        return FormBuilder::boot($method, $route, 'campaign_add_users')
                ->class('campaign-add-users-form')
                ->add(FormElement::hidden('id', $model))
                ->add(FormElement::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $exclude)->required()->label(__('forms.campaigns.users.add')))
                ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {

        return [

        ];
    }
}
