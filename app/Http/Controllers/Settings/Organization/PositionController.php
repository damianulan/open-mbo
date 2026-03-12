<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\PositionsDataTable;
use App\Forms\Settings\Organization\PositionEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Position;
use Illuminate\Http\Request;

class PositionController extends SettingsController
{
    public function index(PositionsDataTable $dataTable)
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.positions.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(Request $request, PositionEditForm $form)
    {
        $this->addPageNav();

        return view('pages.settings.organization.positions.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, PositionEditForm $form)
    {
        $form->validate();
        $position = Position::fillFromRequest();

        if ($position->save()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Request $request, $id, PositionEditForm $form)
    {
        $this->addPageNav();
        $position = Position::findOrFail($id);

        return view('pages.settings.organization.positions.edit', [
            'position' => $position,
            'form' => $form->setModel($position)->getDefinition(),
        ]);
    }

    public function update(Request $request, $id, PositionEditForm $form)
    {
        $position = Position::findOrFail($id);
        $form->validate();
        $position = Position::fillFromRequest($id);

        if ($position->update()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Request $request, Position $position)
    {
        if ($position->delete()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
