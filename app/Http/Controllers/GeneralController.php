<?php

namespace App\Http\Controllers;

use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Forms\MBO\Objective\ObjectiveEditForm;
use App\Forms\MBO\Objective\ObjectiveEditUserForm;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use Illuminate\Http\Request;

class GeneralController extends AppController
{
    public function getModal(Request $request)
    {
        $type = $request->input('type') ?? null;
        $id = $request->input('id') ?? null;
        $status = 'error';
        $message = 'error';
        $view = null;
        $params = [];

        switch ($type) {
            case 'campaigns.add_objectives':

                if ($id) {
                    $objective = Objective::checkAccess()->find($id);
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
                // $id - objective_id
                if ($id) {
                    $campaign = Campaign::checkAccess()->find($id);
                    if ($campaign) {
                        $params = [
                            'id' => $id,
                            'form' => CampaignEditUserForm::definition($request, $campaign),
                        ];
                        $status = 'ok';
                    }
                }

                break;

            case 'objectives.add_users':
                if ($id) {
                    $objective = Objective::checkAccess()->find($id);
                    if ($objective) {
                        $params = [
                            'id' => $id,
                            'form' => ObjectiveEditUserForm::definition($request, $objective),
                        ];
                        $status = 'ok';
                    }
                }

                break;

            case 'objectives.add_objectives':

                if ($id) {
                    $objective = Objective::checkAccess()->find($id);
                    if ($objective) {
                        $params = [
                            'id' => $id,
                            'form' => ObjectiveEditForm::definition($request, $objective),
                        ];
                        $status = 'ok';
                    }
                } else {
                    $params = [
                        'form' => ObjectiveEditForm::definition($request),
                    ];
                    $status = 'ok';
                }

                break;

            default:
                // code...
                break;
        }

        if ($status === 'ok') {
            $view = view('components.modals.'.$type, $params)->render();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'view' => $view,
        ]);
    }
}
