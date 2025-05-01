<?php

namespace App\Http\Controllers\Objectives;

use Illuminate\Http\Request;
use App\Forms\MBO\Objective\ObjectiveTemplateEditForm;
use App\Models\MBO\ObjectiveTemplate;
use App\Http\Controllers\Management\ManagementController;

class ObjectiveTemplateController extends ManagementController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.management.index', [
            'objectives' => ObjectiveTemplate::paginate(30),
            'nav' => $this->nav(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('components.forms.edit', [
            'form' => ObjectiveTemplateEditForm::definition($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ObjectiveTemplateEditForm $form)
    {
        $request->validate($form::validation($request));
        $objective = ObjectiveTemplate::fillFromRequest($request);

        if ($objective->save()) {
            return redirect()->route('management.mbo.objectives.index')->with('success', __('alerts.objective_template.success.create'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.management.objectives.show', [
            'objective' => ObjectiveTemplate::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = ObjectiveTemplate::findOrFail($id);
        return view('components.forms.edit', [
            'objective' => $model,
            'form' => ObjectiveTemplateEditForm::definition($request, $model),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ObjectiveTemplateEditForm $form)
    {
        $request->validate($form::validation($request, $id));
        $objective = ObjectiveTemplate::fillFromRequest($request, $id);
        if ($objective->update()) {
            return redirect()->route('management.mbo.objectives.index')->with('success', __('alerts.objective_template.success.edit'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete($id)
    {
        $objective = ObjectiveTemplate::findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('management.mbo.objectives.index')->with('success', __('alerts.objective_template.success.delete'));
        }
        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
