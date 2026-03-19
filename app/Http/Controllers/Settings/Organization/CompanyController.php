<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\CompaniesDataTable;
use App\Forms\Settings\Organization\CompanyEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends SettingsController
{
    public function index(CompaniesDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.company.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(CompanyEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.company.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(CompanyEditForm $form): RedirectResponse
    {
        $form->validate();
        $company = Company::fillFromRequest();

        if ($company->save()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Company $company, CompanyEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.company.edit', [
            'company' => $company,
            'form' => $form->setModel($company)->getDefinition(),
        ]);
    }

    public function update(Company $company, CompanyEditForm $form): RedirectResponse
    {
        $form->validate();
        $company = Company::fillFromRequest($company->getKey());

        if ($company->update()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Company $company): RedirectResponse
    {
        if ($company->delete()) {
            return redirect()->route('settings.organization.company.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
