<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Objective;
use App\Http\Controllers\AppController;
use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;

class CampaignObjectiveController extends AppController
{

    public function store(Request $request, CampaignEditObjectiveForm $form)
    {
        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request);
        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($request);
            if ($objective->save()) {
                $response['message'] = __('alerts.campaigns.success.objective_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

    public function update(Request $request, $id, CampaignEditObjectiveForm $form)
    {
        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request, $id);
        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($request, $id);

            if ($objective->update()) {
                $response['message'] = __('alerts.campaigns.success.objective_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

    public function delete(Request $request, $id)
    {
        $objective = Objective::findOrFail($id);
        if ($objective->delete()) {
            return ajax()->ok('message', __('alerts.campaigns.success.objective_deleted'));
        }
        return ajax()->error('message', __('alerts.campaigns.error.objective_deleted'));
    }
}
