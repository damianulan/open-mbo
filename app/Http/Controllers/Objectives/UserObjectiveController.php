<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Models\MBO\Objective;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserObjective;
use App\Enums\MBO\UserObjectiveStatus;
use Illuminate\Support\Facades\Auth;
use App\Forms\MBO\Objective\ObjectiveEditUserForm;

class UserObjectiveController extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $userObjective = UserObjective::checkAccess()->findOrFail($id);
        $this->logShow($userObjective);

        $header = 'Podsumowanie Celu';
        return view('pages.mbo.objectives.users.show', [
            'userObjective' => $userObjective,
            'user' => $userObjective->user,
            'objective' => $userObjective->objective,
            'pagetitle' => $header,
            'isOwner' => $userObjective->user->id === Auth::user()->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id, ObjectiveEditUserForm $form)
    {
        $objective = Objective::findOrFail($id);

        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request, $id);
        if ($response['status'] === 'ok') {

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
    public function destroy(string $id)
    {
        //
    }
}
