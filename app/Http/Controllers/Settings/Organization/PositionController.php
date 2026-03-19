<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\PositionsDataTable;
use App\Forms\Settings\Organization\PositionEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Position;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositionController extends SettingsController
{
    public function index(PositionsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.positions.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(PositionEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.positions.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(PositionEditForm $form): RedirectResponse
    {
        $form->validate();
        $position = Position::fillFromRequest();

        if ($position->save()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Position $position, PositionEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.positions.edit', [
            'position' => $position,
            'form' => $form->setModel($position)->getDefinition(),
        ]);
    }

    public function update(Position $position, PositionEditForm $form): RedirectResponse
    {
        $form->validate();
        $position = Position::fillFromRequest($position->getKey());

        if ($position->update()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Position $position): RedirectResponse
    {
        if ($position->delete()) {
            return redirect()->route('settings.organization.positions.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
