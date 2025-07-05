<?php

namespace App\Http\Controllers\Objectives;

use App\Forms\MBO\Objective\ObjectiveTemplateEditForm;
use App\Models\MBO\ObjectiveTemplate;
use Illuminate\Http\Request;

class ObjectiveTemplateController extends MBOController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.mbo.index', [
            'objectives' => ObjectiveTemplate::checkAccess()->paginate(30),
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
            'form' => ObjectiveTemplateEditForm::definition($request),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ObjectiveTemplateEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $request->validate();

        $objective = ObjectiveTemplate::fillFromRequest($request);

        if ($objective->save()) {
            return redirect()->route('mbo.templates.index')->with('success', __('alerts.objective_template.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * Display the specified resource.
     *
     * @TODO add view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = ObjectiveTemplate::checkAccess()->findOrFail($id);

        return view('components.forms.edit', [
            'objective' => $model,
            'form' => ObjectiveTemplateEditForm::definition($request, $model),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ObjectiveTemplateEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request, $id);
        $objective = ObjectiveTemplate::fillFromRequest($request, $id);
        if ($objective->update()) {
            return redirect()->route('mbo.templates.index')->with('success', __('alerts.objective_template.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete($id)
    {
        $objective = ObjectiveTemplate::checkAccess()->findOrFail($id);
        if ($objective->delete()) {
            return redirect()->route('mbo.templates.index')->with('success', __('alerts.objective_template.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }
}
