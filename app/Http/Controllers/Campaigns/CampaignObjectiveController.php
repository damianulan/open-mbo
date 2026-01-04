<?php

namespace App\Http\Controllers\Campaigns;

use App\Forms\MBO\Campaign\CampaignEditObjectiveForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Objective;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CampaignObjectiveController extends AppController
{
    public function store(Request $request, CampaignEditObjectiveForm $form)
    {

        $response = $form->validateJson();
        if ('ok' === $response['status']) {
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

        $response = $form->validateJson();
        if ('ok' === $response['status']) {
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

    public function addObjectives(Request $request, $id): View
    {
        $params = array();
        $form = null;
        if ($id) {
            $objective = Objective::find($id);
            if ($objective) {
                $form = CampaignEditObjectiveForm::bootWithModel($objective);
            }
        } else {
            $form = CampaignEditObjectiveForm::bootWithAttributes($request->get('datas'));
        }
        if($form){
            $params = array(
                'id' => $id,
                'form' => $form->getDefinition(),
            );
        }

        return view('components.modals.campaigns.add_objectives', $params);
    }
}
