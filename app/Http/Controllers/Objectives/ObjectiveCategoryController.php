<?php

namespace App\Http\Controllers\Objectives;

use App\DataTables\MBO\ObjectiveCategoriesDataTable;
use App\Forms\MBO\Objective\ObjectiveCategoryEditForm;
use App\Models\MBO\ObjectiveTemplateCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectiveCategoryController extends MBOController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObjectiveCategoriesDataTable $dataTable)
    {
        return $dataTable->render('pages.mbo.categories.index', array(
            'table' => $dataTable,
            'nav' => $this->nav(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, ObjectiveCategoryEditForm $form): View
    {
        return view('pages.mbo.categories.edit', array(
            'form' => $form->getDefinition(),
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ObjectiveCategoryEditForm $form)
    {
        $form->validate();
        $objective = ObjectiveTemplateCategory::fillFromRequest();
        $user_ids = $request->input('user_ids');

        if ($objective->save()) {
            $objective->refreshCoordinators($user_ids);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id, ObjectiveCategoryEditForm $form)
    {
        $model = ObjectiveTemplateCategory::findOrFail($id);

        return view('pages.mbo.categories.edit', array(
            'objective' => $model,
            'form' => $form->setModel($model)->getDefinition(),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed  $id
     */
    public function update(Request $request, $id, ObjectiveCategoryEditForm $form)
    {
        $form->validate();
        $objective = ObjectiveTemplateCategory::fillFromRequest($id);
        $user_ids = $request->input('user_ids');
        if ($objective->update()) {
            $objective->refreshCoordinators($user_ids);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $objective = ObjectiveTemplateCategory::findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_categories.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
