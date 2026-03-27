<?php

namespace App\Http\Controllers\Objectives;

use App\Forms\Mbo\Objective\ObjectiveTemplateEditForm;
use App\Models\Mbo\ObjectiveTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObjectiveTemplateController extends MBOController
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $this->addPageNav();

        return view('pages.mbo.index', [
            'objectives' => ObjectiveTemplate::paginate(30),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ObjectiveTemplateEditForm $form): View
    {
        return view('components.forms.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
     * Display the specified resource.
     *
     * @TODO add view
     *
     * @param  int  $id
     */
    public function show($id): void {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(ObjectiveTemplate $objective, ObjectiveTemplateEditForm $form): View
    {
        return view('components.forms.edit', [
            'objective' => $objective,
            'form' => $form->setModel($objective)->getDefinition(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
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
