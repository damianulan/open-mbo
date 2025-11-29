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
     * @param ObjectiveCategoriesDataTable $dataTable
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
     * @param Request $request
     */
    public function create(Request $request): View
    {
        return view('pages.mbo.categories.edit', array(
            'form' => ObjectiveCategoryEditForm::definition($request),
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param ObjectiveCategoryEditForm $form
     */
    public function store(Request $request, ObjectiveCategoryEditForm $form)
    {
        $request->validate($form::validation($request));
        $objective = ObjectiveTemplateCategory::fillFromRequest($request);
        $user_ids = $request->input('user_ids');

        if ($objective->save()) {
            $objective->refreshCoordinators($user_ids);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id): void {}

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param string $id
     */
    public function edit(Request $request, string $id)
    {
        $model = ObjectiveTemplateCategory::findOrFail($id);

        return view('pages.mbo.categories.edit', array(
            'objective' => $model,
            'form' => ObjectiveCategoryEditForm::definition($request, $model),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed  $id
     * @param Request $request
     * @param ObjectiveCategoryEditForm $form
     */
    public function update(Request $request, $id, ObjectiveCategoryEditForm $form)
    {
        $request->validate($form::validation($request, $id));
        $objective = ObjectiveTemplateCategory::fillFromRequest($request, $id);
        $user_ids = $request->input('user_ids');
        if ($objective->update()) {
            $objective->refreshCoordinators($user_ids);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function delete(string $id)
    {
        $objective = ObjectiveTemplateCategory::findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_categories.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
