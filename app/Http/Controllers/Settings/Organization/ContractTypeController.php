<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\ContractTypesDataTable;
use App\Forms\Settings\Organization\ContractTypeEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\TypeOfContract;
use Illuminate\Http\Request;

class ContractTypeController extends SettingsController
{
    public function index(ContractTypesDataTable $dataTable)
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.contracts.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(Request $request, ContractTypeEditForm $form)
    {
        $this->addPageNav();

        return view('pages.settings.organization.contracts.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, ContractTypeEditForm $form)
    {
        $form->validate();
        $contractType = TypeOfContract::fillFromRequest();

        if ($contractType->save()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Request $request, $id, ContractTypeEditForm $form)
    {
        $this->addPageNav();
        $contractType = TypeOfContract::findOrFail($id);

        return view('pages.settings.organization.contracts.edit', [
            'contract' => $contractType,
            'form' => $form->setModel($contractType)->getDefinition(),
        ]);
    }

    public function update(Request $request, $id, ContractTypeEditForm $form)
    {
        $contractType = TypeOfContract::findOrFail($id);
        $form->validate();
        $contractType = TypeOfContract::fillFromRequest($id);

        if ($contractType->update()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Request $request, TypeOfContract $contract)
    {
        if ($contract->delete()) {
            return redirect()->route('settings.organization.contracts.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
