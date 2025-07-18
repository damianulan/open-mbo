<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\CompaniesDataTable;
use App\Forms\Settings\Organization\CompanyEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Company;
use Illuminate\Http\Request;

class CompanyController extends SettingsController
{
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.organization.company.index', [
            'nav' => $this->nav(),
        ]);
    }

    public function create(Request $request)
    {
        return view('pages.settings.organization.company.edit', [
            'form' => CompanyEditForm::definition($request),
        ]);
    }

    public function store(Request $request, CompanyEditForm $form)
    {
        $request->validate($form::validation($request));
        $company = Company::fillFromRequest($request);

        if ($company->save()) {

            return redirect()->route('users.show', $company->id)->with('success', __('alerts.users.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.users.error.create'));
    }

    public function edit(Request $request, $id)
    {
        $model = Company::findOrFail($id);

        return view('pages.users.edit', [
            'user' => $model,
            'form' => CompanyEditForm::definition($request, $model),
        ]);
    }

    public function update(Request $request, $id, CompanyEditForm $form)
    {
        $request->validate($form::validation($request, $id));
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
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', ['name' => $company->name()]));
        }

        return redirect()->back()->with('error', __('alerts.users.error.delete', ['name' => $company->name()]));
    }
}
