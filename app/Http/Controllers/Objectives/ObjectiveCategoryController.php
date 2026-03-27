<?php

namespace App\Http\Controllers\Objectives;

use App\DataTables\Mbo\ObjectiveCategoriesDataTable;
use App\Forms\Mbo\Objective\ObjectiveCategoryEditForm;
use App\Models\Mbo\ObjectiveTemplateCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectiveCategoryController extends MBOController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObjectiveCategoriesDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.mbo.categories.index', [
            'table' => $dataTable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ObjectiveCategoryEditForm $form): View
    {
        return view('pages.mbo.categories.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ObjectiveCategoryEditForm $form): RedirectResponse
    {
        $form->validate();
        $objective = ObjectiveTemplateCategory::fillFromRequest();
        $userIds = $request->input('user_ids');

        if ($objective->save()) {
            $objective->refreshCoordinators($userIds);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $id
     */
    public function show($id): void {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  mixed  $id
     */
    public function edit(ObjectiveTemplateCategory $objective, ObjectiveCategoryEditForm $form): View
    {
        return view('pages.mbo.categories.edit', [
            'objective' => $objective,
            'form' => $form->setModel($objective)->getDefinition(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed  $id
     */
    public function update(Request $request, ObjectiveTemplateCategory $objective, ObjectiveCategoryEditForm $form): RedirectResponse
    {
        $form->validate();
        $objective = ObjectiveTemplateCategory::fillFromRequest($objective->getKey());
        $userIds = $request->input('user_ids');

        if ($objective->update()) {
            $objective->refreshCoordinators($userIds);

            return redirect()->route('categories.index')->with('success', __('alerts.objective_categories.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $id
     */
    public function delete(ObjectiveTemplateCategory $objective): RedirectResponse
    {
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_categories.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
