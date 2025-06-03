<?php

namespace App\Http\Controllers\Objectives;

use Illuminate\Http\Request;
use App\Http\Controllers\Objectives\MBOController;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\DataTables\MBO\ObjectiveCategoriesDataTable;
use App\Forms\MBO\Objective\ObjectiveCategoryEditForm;

class ObjectiveCategoryController extends MBOController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObjectiveCategoriesDataTable $dataTable)
    {
        return $dataTable->render('pages.mbo.categories.index', [
            'table' => $dataTable,
            'nav' => $this->nav(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pages.mbo.categories.edit', [
            'form' => ObjectiveCategoryEditForm::definition($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ObjectiveCategoryEditForm $form)
    {
        $request->validate($form::validation($request));
        $objective = ObjectiveTemplateCategory::fillFromRequest($request);
        $user_ids = $request->input('user_ids');

        if ($objective->save()) {
            $objective->refreshCoordinators($user_ids);
            return redirect()->route('mbo.categories.index')->with('success', __('alerts.objective_categories.success.create'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $model = ObjectiveTemplateCategory::findOrFail($id);
        return view('pages.mbo.categories.edit', [
            'objective' => $model,
            'form' => ObjectiveCategoryEditForm::definition($request, $model),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, ObjectiveCategoryEditForm $form)
    {
        $request->validate($form::validation($request, $id));
        $objective = ObjectiveTemplateCategory::fillFromRequest($request, $id);
        $user_ids = $request->input('user_ids');
        if ($objective->update()) {
            $objective->refreshCoordinators($user_ids);
            return redirect()->route('mbo.categories.index')->with('success', __('alerts.objective_categories.success.edit'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $objective = ObjectiveTemplateCategory::findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('mbo.templates.index')->with('success', __('alerts.objective_categories.success.delete'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
