<?php

namespace App\Http\Controllers\Management\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business\Company;
use App\DataTables\Management\CompaniesDataTable;
use App\Forms\Management\CompanyEditForm;
use App\Http\Controllers\Management\ManagementController;

class CompanyController extends ManagementController
{

    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('pages.management.organization.company.index', [
            'nav' => $this->nav(),
        ]);
    }

    public function create()
    {
        return view('pages.management.organization.company.edit', [
            'form' => CompanyEditForm::definition()
        ]);
    }

    public function store(Request $request, CompanyEditForm $form)
    {
        $request->validate($form::validation());
        $company = Company::fillFromRequest($request);

        if ($company->save()) {

            return redirect()->route('users.show', $company->id)->with('success', __('alerts.users.success.create'));
        }
        return redirect()->back()->with('error', __('alerts.users.error.create'));
    }

    public function edit($id)
    {
        $model = Company::findOrFail($id);
        return view('pages.users.edit', [
            'user' => $model,
            'form' => CompanyEditForm::definition($model)
        ]);
    }

    public function update(Request $request, $id, CompanyEditForm $form)
    {
        $request->validate($form::validation());
        $company = Company::fillFromRequest($request, $id);

        if ($company->update()) {
            return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.edit', ['name' => $company->name()]));
        }
        return redirect()->back()->with('error', __('alerts.users.error.edit', ['name' => $company->name()]));
    }

    public function delete($id)
    {
        $company = Company::findOrFail($id);

        if ($company->delete()) {
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', ['name' => $user->name()]));
        }
        return redirect()->back()->with('error', __('alerts.users.error.delete', ['name' => $user->name()]));
    }
}
