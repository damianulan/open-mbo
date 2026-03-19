<?php

namespace App\Http\Controllers\Objectives;

use App\DataTables\MBO\ObjectiveDataTable;
use App\Forms\MBO\Objective\ObjectiveEditForm;
use App\Models\MBO\Objective;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObjectiveController extends MBOController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObjectiveDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.mbo.objectives.index', [
            'table' => $dataTable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(ObjectiveEditForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ('ok' === $response['status']) {
            $objective = Objective::fillFromRequest();

            if ($objective->save()) {
                $response['message'] = __('alerts.objectives.success.objective_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $id
     */
    public function show(int|string $id): View
    {
        $objective = Objective::findOrFail($id);
        $this->logShow($objective);

        $header = 'Podsumowanie Celu';

        return view('pages.mbo.objectives.show', [
            'objective' => $objective,
            'pagetitle' => $header,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  mixed  $id
     */
    public function edit($id): void {}

    public function update(Objective $objective, ObjectiveEditForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ('ok' === $response['status']) {
            $objective = Objective::fillFromRequest($objective->getKey());

            if ($objective->update()) {
                $response['message'] = __('alerts.objectives.success.objective_updated');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $id
     */
    public function destroy($id): void {}

    public function addObjectives(Request $request, int|string|null $id): View
    {
        $params = [];

        if ($id) {
            $objective = Objective::find($id);

            if ($objective) {
                $params = [
                    'id' => $id,
                    'form' => ObjectiveEditForm::bootWithModel($objective)->getDefinition(),
                ];
            }
        } else {
            $params = [
                'form' => ObjectiveEditForm::bootWithAttributes($request->get('datas')),
            ];
        }

        return view('components.modals.objectives.add_objectives', $params);
    }
}
