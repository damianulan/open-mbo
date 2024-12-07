<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Enums\MBO\CampaignStage;
use App\Http\Controllers\Controller;
use App\Forms\MBO\Campaign\CampaignEditUserForm;

class CampaignUserController extends Controller
{

    public function update(Request $request, $id, CampaignEditUserForm $form)
    {
        $campaign = Campaign::find($id);

        $request = $form::reformatRequest($request);
        $response = $form::validate($request, $id);
        if($response['status'] === 'ok'){
            foreach($request->input('user_ids') as $user_id){
                $campaign->assignUser($user_id);
            }
            if($objective->update()){
                $response['message'] = __('alerts.campaigns.success.users_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }
}
