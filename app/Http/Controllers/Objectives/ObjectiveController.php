<?php

namespace App\Http\Controllers\Objectives;

use App\Contracts\Repositories\ObjectiveRepositoryContract;
use App\DataTables\Mbo\ObjectiveDataTable;
use App\Forms\Mbo\Objective\ObjectiveEditForm;
use App\Models\Mbo\Objective;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObjectiveController extends MBOController
{
    public function index(ObjectiveDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.mbo.objectives.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(): void {}

    public function store(ObjectiveEditForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest();

            if ($objective->save()) {
                $response['message'] = __('alerts.objectives.success.objective_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function show(Objective $objective, ObjectiveRepositoryContract $objectiveRepository): View
    {
        $objective = $objectiveRepository->findForShow($objective->getKey());
        $this->logShow($objective);

        $header = 'Podsumowanie Celu';
        $this->setPagetitle($header);

        return view('pages.mbo.objectives.show', [
            'objective' => $objective,
            'pagetitle' => $header,
        ]);
    }

    public function edit($id): void {}

    public function update(Objective $objective, ObjectiveEditForm $form): JsonResponse
    {
        $response = $form->validateJson();

        if ($response['status'] === 'ok') {
            $objective = Objective::fillFromRequest($objective->getKey());

            if ($objective->update()) {
                $response['message'] = __('alerts.objectives.success.objective_updated');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function destroy($id): void {}

    public function addObjectives(Request $request, int|string|null $id, ObjectiveRepositoryContract $objectiveRepository): View
    {
        $params = [];

        if ($id) {
            $objective = $objectiveRepository->find($id, [
                'campaign',
                'template',
            ]);

            if ($objective) {
                $params = [
                    'id' => $objective,
                    'form' => ObjectiveEditForm::bootWithModel($objective)->getDefinition(),
                ];
            }
        } else {
            $params = [
                'form' => ObjectiveEditForm::bootWithAttributes($request->input('datas')),
            ];
        }

        return view('components.modals.objectives.add_objectives', $params);
    }
}
