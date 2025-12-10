<?php

namespace App\Http\Controllers\Objectives;

use App\Exceptions\Core\NoPermissionException;
use App\Forms\MBO\Objective\ObjectiveEditUserForm;
use App\Forms\MBO\Objective\ObjectiveEditUserRealizationForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Objective;
use App\Models\MBO\UserObjective;
use App\Services\Objectives\BulkAssignUsers;
use App\Services\Objectives\UserRealizationUpdate;
use AppException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserObjectiveController extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void {}

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $userObjective = UserObjective::findOrFail($id);
        if ($request->user()->cannot('view', $userObjective)) {
            unauthorized();
        }
        $this->logShow($userObjective);

        $header = 'Podsumowanie Celu';

        return view('pages.mbo.objectives.users.show', array(
            'userObjective' => $userObjective,
            'user' => $userObjective->user,
            'objective' => $userObjective->objective,
            'pagetitle' => $header,
            'isOwner' => $userObjective->user->id === Auth::user()->id,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void {}

    public function update(Request $request, $id, ObjectiveEditUserForm $form)
    {
        $objective = Objective::findOrFail($id);


        $response = $form::validateJson($request, $id);
        if ('ok' === $response['status']) {

            $service = BulkAssignUsers::boot(request: $request, objective: $objective)->execute();
            if ($service->passed()) {
                $response['message'] = __('alerts.objectives.success.users_added');

                return response()->json($response);
            }
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void {}

    public function addUsers(Request $request, $id): View
    {
        $params = array();
        if ($id) {
            $objective = Objective::find($id);
            if ($objective) {
                $params = array(
                    'id' => $id,
                    'form' => ObjectiveEditUserForm::definition($request, $objective),
                );
            }
        }

        return view('components.modals.objectives.add_users', $params);
    }

    public function editRealization(Request $request, $id): View
    {
        $params = array();
        if ($id) {
            $objective = UserObjective::findOrFail($id);
            $params = array(
                'id' => $id,
                'form' => ObjectiveEditUserRealizationForm::definition($request, $objective),
            );
        }

        return view('components.modals.objectives.edit_realization', $params);
    }

    public function updateEvaluation(Request $request, $id, ObjectiveEditUserRealizationForm $form): JsonResponse
    {
        $response['status'] = 'error';
        try {
            $userObjective = UserObjective::findOrFail($id);
            if ( ! $userObjective->canBeEvaluated()) {
                throw new NoPermissionException();
            }


            $response = $form::validateJson($request, $id);
            if ('ok' === $response['status']) {

                $service = UserRealizationUpdate::boot(request: $request, userObjective: $userObjective)->execute();
                if ($service->passed()) {
                    $response['message'] = __('alerts.objectives.success.realization_updated');

                    return response()->json($response);
                }
                $errors = $service->getErrors();
                if ( ! empty($errors)) {
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

    public function pass(Request $request, $id)
    {
        try {
            $userObjective = UserObjective::findOrFail($id);

            DB::beginTransaction();
            if ($userObjective->canBePassed()) {
                $userObjective->setPassed()->update();
            } else {
                throw new AppException(__('alerts.user_objectives.error.set_passed'));
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            $this->e = $th;
        }

        $redirect = redirect()->back()->with('success', __('alerts.user_objectives.success.set_passed'));

        return $this->returnResponseRedirect($redirect);
    }

    public function fail(Request $request, $id)
    {
        try {
            $userObjective = UserObjective::findOrFail($id);

            DB::beginTransaction();
            if ($userObjective->canBeFailed()) {
                $userObjective->setFailed()->update();
            } else {
                throw new AppException(__('alerts.user_objectives.error.set_failed'));
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            $this->e = $th;
        }

        $redirect = redirect()->back()->with('success', __('alerts.user_objectives.success.set_failed'));

        return $this->returnResponseRedirect($redirect);
    }
}
