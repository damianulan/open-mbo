<?php

namespace App\Http\Controllers\Objectives;

use App\Contracts\Repositories\ObjectiveRepositoryContract;
use App\Contracts\Repositories\UserObjectiveRepositoryContract;
use App\Exceptions\Core\NoPermissionException;
use App\Forms\Mbo\Objective\ObjectiveEditUserForm;
use App\Forms\Mbo\Objective\ObjectiveEditUserRealizationForm;
use App\Http\Controllers\AppController;
use App\Models\Mbo\Objective;
use App\Services\Objectives\BulkAssignUsers;
use App\Services\Objectives\UserRealizationUpdate;
use AppException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserObjectiveController extends AppController
{
    public function index(): void {}

    public function create(): void {}

    public function store(Request $request): void {}

    /**
     * @param mixed $id
     */
    public function show(Request $request, int|string $id, UserObjectiveRepositoryContract $userObjectiveRepository): View
    {
        $userObjective = $userObjectiveRepository->findForShow($id);

        if ($request->user()->cannot('view', $userObjective)) {
            unauthorized();
        }
        $this->logShow($userObjective);

        $header = 'Podsumowanie Celu';
        $this->setPagetitle($header);

        return view('pages.mbo.objectives.users.show', [
            'userObjective' => $userObjective,
            'user' => $userObjective->user,
            'objective' => $userObjective->objective,
            'pagetitle' => $header,
            'isOwner' => $userObjective->user->id === Auth::user()->id,
        ]);
    }

    public function edit($id): void {}

    public function update(Request $request, Objective $objective, ObjectiveEditUserForm $form): JsonResponse
    {
        $response = $form->validateJson($request, $objective->getKey());

        if ($response['status'] === 'ok') {
            $service = BulkAssignUsers::boot(request: $request, objective: $objective)->execute();

            if ($service->passed()) {
                $response['message'] = __('alerts.objectives.success.users_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    public function destroy($id): void {}

    public function addUsers(Request $request, int|string|null $id, ObjectiveRepositoryContract $objectiveRepository): View
    {
        $params = [];

        if ($id) {
            $objective = $objectiveRepository->find($id);

            if ($objective) {
                $params = [
                    'id' => $id,
                    'form' => ObjectiveEditUserForm::bootWithModel($objective)->getDefinition(),
                ];
            }
        }

        return view('components.modals.objectives.add_users', $params);
    }

    public function editRealization(Request $request, int|string|null $id, UserObjectiveRepositoryContract $userObjectiveRepository): View
    {
        $params = [];

        if ($id) {
            $objective = $userObjectiveRepository->findOrFail($id, ['objective']);
            $params = [
                'id' => $id,
                'form' => ObjectiveEditUserRealizationForm::bootWithModel($objective)->getDefinition(),
            ];
        }

        return view('components.modals.objectives.edit_realization', $params);
    }

    public function updateEvaluation(Request $request, $id, ObjectiveEditUserRealizationForm $form, UserObjectiveRepositoryContract $userObjectiveRepository): JsonResponse
    {
        $response = ['status' => 'error'];

        try {
            $userObjective = $userObjectiveRepository->findOrFail($id, ['objective']);

            if (! $userObjective->canBeEvaluated()) {
                throw new NoPermissionException;
            }

            $response = $form->validateJson();

            if ($response['status'] === 'ok') {
                $service = UserRealizationUpdate::boot(request: $request, userObjective: $userObjective)->execute();

                if ($service->passed()) {
                    $response['message'] = __('alerts.objectives.success.realization_updated');

                    return response()->json($response);
                }

                $errors = $service->getErrors();

                if (! empty($errors)) {
                    $response['message'] = $errors[0];
                }
            } else {
                $response['message'] = __('alerts.error.form');
            }
        } catch (Throwable $th) {
            report($th);
            $this->e = $th;

            return $this->responseJson(false);
        }

        return response()->json($response);
    }

    public function pass(int|string $id, UserObjectiveRepositoryContract $userObjectiveRepository): RedirectResponse|UrlGenerator
    {
        try {
            DB::transaction(function () use ($id, $userObjectiveRepository): void {
                $userObjective = $userObjectiveRepository->findOrFail($id, ['objective.campaign']);

                if (! $userObjective->canBePassed()) {
                    throw new AppException(__('alerts.user_objectives.error.set_passed'));
                }

                $userObjective->setPassed()->update();
            });
        } catch (Throwable $th) {
            $this->e = $th;
        }

        $redirect = redirect()->back()->with('success', __('alerts.user_objectives.success.set_passed'));

        return $this->returnResponseRedirect($redirect);
    }

    public function fail(int|string $id, UserObjectiveRepositoryContract $userObjectiveRepository): RedirectResponse|UrlGenerator
    {
        try {
            DB::transaction(function () use ($id, $userObjectiveRepository): void {
                $userObjective = $userObjectiveRepository->findOrFail($id, ['objective.campaign']);

                if (! $userObjective->canBeFailed()) {
                    throw new AppException(__('alerts.user_objectives.error.set_failed'));
                }

                $userObjective->setFailed()->update();
            });
        } catch (Throwable $th) {
            $this->e = $th;
        }

        $redirect = redirect()->back()->with('success', __('alerts.user_objectives.success.set_failed'));

        return $this->returnResponseRedirect($redirect);
    }
}
