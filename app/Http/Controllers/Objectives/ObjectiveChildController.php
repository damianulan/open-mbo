<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forms\MBO\Objective\ObjectiveChildEditForm;
use App\Models\MBO\Objective;

class ObjectiveChildController extends Controller
{
    public function store(Request $request, ObjectiveChildEditForm $form)
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

    public function update(Request $request, $id, ObjectiveChildEditForm $form)
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
