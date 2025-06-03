<?php

namespace App\Http\Controllers\Objectives;

use Illuminate\Http\Request;
use App\Models\MBO\Objective;
use App\Http\Controllers\Objectives\MBOController;
use App\DataTables\MBO\ObjectiveDataTable;
use App\Forms\MBO\Objective\ObjectiveEditForm;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Enums\MBO\UserObjectiveStatus;

class ObjectiveController extends MBOController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObjectiveDataTable $dataTable)
    {
        return $dataTable->render('pages.mbo.objectives.index', [
            'table' => $dataTable,
            'nav' => $this->nav(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ObjectiveEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request);
        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($request);

            if ($objective->save()) {
                $response['message'] = __('alerts.objectives.success.objective_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $objective = Objective::checkAccess()->findOrFail($id);
        $this->logShow($objective);

        $header = 'Podsumowanie Celu';
        return view('pages.mbo.objectives.show', [
            'objective' => $objective,
            'pagetitle' => $header,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id, ObjectiveEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request, $id);
        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($request, $id);

            if ($objective->update()) {
                $response['message'] = __('alerts.objectives.success.objective_updated');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
