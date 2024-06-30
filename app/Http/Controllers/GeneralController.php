<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;

class GeneralController extends Controller
{

    public function getModal(Request $request)
    {
        $type = $request->input('type') ?? null;
        $id = $request->input('id') ?? null;
        $status = 'error';
        $view = null;
        $params = array();

        switch ($type) {
            case 'campaigns.add_objectives':
                    $params = [
                        'form' => CampaignEditObjectiveForm::boot(null, $request),
                    ];
                    $status = 'ok';
                break;

            case 'campaigns.edit_objective':
                $objective = Objective::find($id);
                if($objective){
                    $params = [
                        'form' => CampaignEditObjectiveForm::boot($objective, $request),
                    ];
                    $status = 'ok';
                }

            break;

            default:
                # code...
                break;
        }

        $view = view('components.modals.'.$type, $params)->render();

        return response()->json([
            'status' => $status,
            'view' => $view,
        ]);
    }
}
