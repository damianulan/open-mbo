<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Forms\MBO\Objective\ObjectiveChildEditForm;
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

                if ($id) {
                    $objective = Objective::find($id);
                    if ($objective) {
                        $params = [
                            'id' => $id,
                            'form' => CampaignEditObjectiveForm::definition($request, $objective),
                        ];
                        $status = 'ok';
                    }
                } else {
                    $params = [
                        'form' => CampaignEditObjectiveForm::definition($request),
                    ];
                    $status = 'ok';
                }


                break;

            case 'campaigns.add_users':
                //$id - objective_id
                if ($id) {
                    $campaign = Campaign::find($id);
                    $params = [
                        'id' => $id,
                        'form' => CampaignEditUserForm::definition($request, $campaign),
                    ];
                    $status = 'ok';
                }

                break;

            case 'objectives.add_child':

                $parent_id = $request->input('parent_id') ?? null;

                if ($id) {
                    $objective = Objective::find($id);
                    if ($objective) {
                        $params = [
                            'id' => $id,
                            'form' => ObjectiveChildEditForm::definition($objective, $request),
                        ];
                        $status = 'ok';
                    }
                } else {
                    $params = [
                        'form' => ObjectiveChildEditForm::definition($request),
                    ];
                    $status = 'ok';
                }


                break;

            default:
                # code...
                break;
        }

        if ($status === 'ok') {
            $view = view('components.modals.' . $type, $params)->render();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'view' => $view,
        ]);
    }
}
