<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;

class GeneralController extends Controller
{

    public function getModal(Request $request)
    {
        $type = $request->input('type') ?? null;
        $id = $request->input('id') ?? null;
        $status = 'error';
        $message = 'error';
        $view = null;
        $params = array();

        switch ($type) {
            case 'campaigns.add_objectives':

                    $campaign_id = $request->input('campaign_id') ?? null;
                    $campaign = Campaign::find($campaign_id);

                    if($id){
                        $objective = Objective::find($id);
                        if($objective){
                            $params = [
                                'id' => $id,
                                'form' => CampaignEditObjectiveForm::boot($objective, $request),
                            ];
                            $status = 'ok';
                        }

                    } else {
                        $params = [
                            'form' => CampaignEditObjectiveForm::boot(null, $request),
                        ];
                        $status = 'ok';
                    }


                break;

            case 'campaigns.add_users':
                    //$id - objective_id
                    if($id){
                        $campaign = Campaign::find($id);
                        $params = [
                            'id' => $id,
                            'form' => CampaignEditUserForm::boot($campaign, $request),
                        ];
                        $status = 'ok';

                    }

                break;

            default:
                # code...
                break;
        }

        if($status === 'ok'){
            $view = view('components.modals.'.$type, $params)->render();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'view' => $view,
        ]);
    }
}
