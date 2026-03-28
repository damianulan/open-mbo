<?php

namespace App\Http\Controllers\Campaigns;

use App\Forms\Mbo\Campaign\CampaignEditObjectiveForm;
use App\Http\Controllers\AppController;
use App\Models\Mbo\Objective;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignObjectiveController extends AppController
{
    public function store(CampaignEditObjectiveForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest();

            if ($objective->save()) {
                $response['message'] = __('alerts.campaigns.success.objective_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function update(Objective $objective, CampaignEditObjectiveForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($objective->getKey());

            if ($objective->update()) {
                $response['message'] = __('alerts.campaigns.success.objective_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function delete(int|string $id): JsonResponse
    {
        $objective = Objective::findOrFail($id);

        if ($objective->delete()) {
            return ajax()->ok('message', __('alerts.campaigns.success.objective_deleted'));
        }

        return ajax()->error('message', __('alerts.campaigns.error.objective_deleted'));
    }

    public function addObjectives(Request $request, int|string|null $id): View
    {
        $params = [];
        $form = null;

        if ($id) {
            $objective = Objective::find($id);

            if ($objective) {
                $form = CampaignEditObjectiveForm::bootWithModel($objective);
            }
        } else {
            $form = CampaignEditObjectiveForm::bootWithAttributes($request->input('datas'));
        }
        if ($form) {
            $params = [
                'id' => $id,
                'form' => $form->getDefinition(),
            ];
        }

        return view('components.modals.campaigns.add_objectives', $params);
    }
}
