<?php

namespace App\Http\Controllers\Objectives;

use App\Forms\Mbo\Objective\ObjectiveTemplateEditForm;
use App\Models\Mbo\ObjectiveTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObjectiveTemplateController extends MBOController
{
    public function index(): View
    {
        $this->addPageNav();

        return view('pages.mbo.index', [
            'objectives' => ObjectiveTemplate::query()
                ->with([
                    'category',
                    'objectives' => fn ($query) => $query->withCount('user_objectives'),
                ])
                ->paginate(30),
        ]);
    }

    public function create(ObjectiveTemplateEditForm $form): View
    {
        return view('components.forms.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(ObjectiveTemplateEditForm $form): RedirectResponse
    {
        $form->validate();

        $objective = ObjectiveTemplate::fillFromRequest();

        if ($objective->save()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_template.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * @TODO add view
     *
     * @param int $id
     */
    public function show($id): void {}

    public function edit(ObjectiveTemplate $objective, ObjectiveTemplateEditForm $form): View
    {
        return view('components.forms.edit', [
            'objective' => $objective,
            'form' => $form->setModel($objective)->getDefinition(),
        ]);
    }

    public function update(ObjectiveTemplate $objective, ObjectiveTemplateEditForm $form): RedirectResponse
    {
        $form->validate();

        $objective = ObjectiveTemplate::fillFromRequest($objective->getKey());

        if ($objective->update()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_template.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(ObjectiveTemplate $objective): RedirectResponse
    {
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_template.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
