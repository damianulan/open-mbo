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
    public function index(ObjectiveCategoriesDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.mbo.categories.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(ObjectiveCategoryEditForm $form): View
    {
        return view('pages.mbo.categories.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

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

    public function edit(ObjectiveTemplateCategory $objective, ObjectiveCategoryEditForm $form): View
    {
        return view('pages.mbo.categories.edit', [
            'objective' => $objective,
            'form' => $form->setModel($objective)->getDefinition(),
        ]);
    }

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

    public function delete(ObjectiveTemplateCategory $objective): RedirectResponse
    {
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_categories.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
