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
        dd($request->input('user_id'));

        $response = $form::validate($request, $id);
        if($response['status'] === 'ok'){
            $objective = Objective::fillFromRequest($request, $id);
            if($objective->update()){
                $response['message'] = __('alerts.campaigns.success.objective_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }
}
