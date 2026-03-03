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
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.company.index');
    }

    public function create(Request $request, CompanyEditForm $form)
    {
        $this->addPageNav();

        return view('pages.settings.organization.company.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, CompanyEditForm $form)
    {
        $form->validate();
        $company = Company::fillFromRequest();

        if ($company->save()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Request $request, $id, CompanyEditForm $form)
    {
        $this->addPageNav();
        $model = Company::findOrFail($id);

        return view('pages.settings.organization.company.edit', [
            'company' => $model,
            'form' => $form->setModel($model)->getDefinition(),
        ]);
    }

    public function update(Request $request, $id, CompanyEditForm $form)
    {
        $model = Company::findOrFail($id);
        $form->validate();
        $company = Company::fillFromRequest($id);

        if ($company->update()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Request $request, Company $company)
    {
        if ($company->delete()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
