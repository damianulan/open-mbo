<?php

namespace App\Http\Controllers\Settings\Organization;

use App\DataTables\Management\TeamsDataTable;
use App\Forms\Settings\Organization\TeamEditForm;
use App\Http\Controllers\Settings\SettingsController;
use App\Models\Business\Team;
use App\Services\Teams\CreateOrUpdate as TeamCreateOrUpdate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends SettingsController
{
    public function index(TeamsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.organization.team.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(TeamEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.team.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, TeamEditForm $form): RedirectResponse
    {
        $form->validate();
        $service = TeamCreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            return redirect()->route('settings.organization.team.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Team $team, TeamEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.team.edit', [
            'team' => $team,
            'form' => $form->setModel($team)->getDefinition(),
        ]);
    }

    public function update(Request $request, Team $team, TeamEditForm $form): RedirectResponse
    {
        $form->validate();
        $service = TeamCreateOrUpdate::boot(request: $request, team: $team)->execute();

        if ($service->passed()) {
            return redirect()->route('settings.organization.team.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Team $team): RedirectResponse
    {
        if ($team->delete()) {
            return redirect()->route('settings.organization.team.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
