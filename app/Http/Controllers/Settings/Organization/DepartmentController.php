<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\DepartmentsDataTable;
use App\Forms\Settings\Organization\DepartmentEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Department;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends SettingsController
{
    public function index(DepartmentsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.departments.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(DepartmentEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.departments.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(DepartmentEditForm $form): RedirectResponse
    {
        $form->validate();
        $department = Department::fillFromRequest();

        if ($department->save()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Department $department, DepartmentEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.departments.edit', [
            'department' => $department,
            'form' => $form->setModel($department)->getDefinition(),
        ]);
    }

    public function update(Department $department, DepartmentEditForm $form): RedirectResponse
    {
        $form->validate();
        $department = Department::fillFromRequest($department->getKey());

        if ($department->update()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Department $department): RedirectResponse
    {
        if ($department->delete()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
