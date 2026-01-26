<?php

namespace App\Http\Controllers\Objectives;

use App\Forms\MBO\Objective\ObjectiveTemplateEditForm;
use App\Models\MBO\ObjectiveTemplate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ObjectiveTemplateController extends MBOController
{
    /**
     * Show the application dashboard.
     */
    public function index(): Renderable
    {
        return view('pages.mbo.index', [
            'objectives' => ObjectiveTemplate::paginate(30),
            'nav' => $this->nav(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, ObjectiveTemplateEditForm $form)
    {
        return view('components.forms.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ObjectiveTemplateEditForm $form)
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
    public function edit(Request $request, $id, ObjectiveTemplateEditForm $form)
    {
        $model = ObjectiveTemplate::findOrFail($id);

        return view('components.forms.edit', [
            'objective' => $model,
            'form' => $form->setModel($model)->getDefinition(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id, ObjectiveTemplateEditForm $form)
    {
        $form->validate();
        $objective = ObjectiveTemplate::fillFromRequest($id);
        if ($objective->update()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_template.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete($id)
    {
        $objective = ObjectiveTemplate::findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('templates.index')->with('success', __('alerts.objective_template.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
