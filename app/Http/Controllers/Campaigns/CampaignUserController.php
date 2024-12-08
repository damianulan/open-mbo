<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Enums\MBO\CampaignStage;
use App\Http\Controllers\Controller;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Models\MBO\UserCampaign;
use App\Models\Core\User;

class CampaignUserController extends Controller
{

    public function update(Request $request, $id, CampaignEditUserForm $form)
    {
        $campaign = Campaign::find($id);
        // $user = User::find('08b30747-f998-4db1-a4e9-277e6b5f2a8f');
        // dd($user->objectives);die;

        $request = $form::reformatRequest($request);
        $response = $form::validate($request, $id);
        $current = UserCampaign::where('campaign_id', $id)->get();
        $current_ids = $current->pluck('user_id')->flip();
        if($response['status'] === 'ok'){

            if($request->input('user_ids')) {
                foreach($request->input('user_ids') as $user_id){
                    if(!$current_ids->has($user_id)){
                        $campaign->assignUser($user_id);
                    } else {
                        $current_ids->forget($user_id);
                    }
                }

                foreach($current_ids as $user_id => $key){
                    $campaign->unassignUser($user_id);
                }
            }

            $response['message'] = __('alerts.campaigns.success.users_added');
            return response()->json($response);
        }
        return response()->json($response);
    }
}
