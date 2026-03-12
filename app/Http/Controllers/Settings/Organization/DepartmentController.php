<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\DepartmentsDataTable;
use App\Forms\Settings\Organization\DepartmentEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Department;
use Illuminate\Http\Request;

class DepartmentController extends SettingsController
{
    public function index(DepartmentsDataTable $dataTable)
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.departments.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(Request $request, DepartmentEditForm $form)
    {
        $this->addPageNav();

        return view('pages.settings.organization.departments.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, DepartmentEditForm $form)
    {
        $form->validate();
        $department = Department::fillFromRequest();

        if ($department->save()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Request $request, $id, DepartmentEditForm $form)
    {
        $this->addPageNav();
        $department = Department::findOrFail($id);

        return view('pages.settings.organization.departments.edit', [
            'department' => $department,
            'form' => $form->setModel($department)->getDefinition(),
        ]);
    }

    public function update(Request $request, $id, DepartmentEditForm $form)
    {
        $department = Department::findOrFail($id);
        $form->validate();
        $department = Department::fillFromRequest($id);

        if ($department->update()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Request $request, Department $department)
    {
        if ($department->delete()) {
            return redirect()->route('settings.organization.departments.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
