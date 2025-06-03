<?php

namespace App\Http\Controllers\Objectives;

use Illuminate\Http\Request;
use App\Models\MBO\Objective;
use App\Http\Controllers\Objectives\MBOController;
use App\DataTables\MBO\ObjectiveDataTable;
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
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
