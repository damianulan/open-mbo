<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\ContractTypesDataTable;
use App\Forms\Settings\Organization\ContractTypeEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\TypeOfContract;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContractTypeController extends SettingsController
{
    public function index(ContractTypesDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.contracts.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(ContractTypeEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.contracts.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(ContractTypeEditForm $form): RedirectResponse
    {
        $form->validate();
        $contractType = TypeOfContract::fillFromRequest();

        if ($contractType->save()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(TypeOfContract $contract, ContractTypeEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.contracts.edit', [
            'contract' => $contract,
            'form' => $form->setModel($contract)->getDefinition(),
        ]);
    }

    public function update(TypeOfContract $contract, ContractTypeEditForm $form): RedirectResponse
    {
        $form->validate();
        $contractType = TypeOfContract::fillFromRequest($contract->getKey());

        if ($contractType->update()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(TypeOfContract $contract): RedirectResponse
    {
        if ($contract->delete()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
