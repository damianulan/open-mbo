<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Enums\MBO\CampaignStage;
use App\Http\Controllers\Controller;
use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;

class CampaignObjectiveController extends Controller
{

    public function store(Request $request, CampaignEditObjectiveForm $form)
    {
        $request = $form::reformatRequest($request);
        $response = $form::validate($request);
        if($response['status'] === 'ok'){
            $objective = Objective::fillFromRequest($request);
            if($objective->save()){
                $response['message'] = __('alerts.campaigns.success.objective_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

}
