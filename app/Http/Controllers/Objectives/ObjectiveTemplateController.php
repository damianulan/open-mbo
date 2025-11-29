<?php

namespace App\Http\Controllers\Objectives;

use App\Forms\MBO\Objective\ObjectiveTemplateEditForm;
use App\Models\MBO\ObjectiveTemplate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ObjectiveTemplateController extends MBOController
{
    /**
     * Show the application dashboard.
     */
    public function index(): Renderable
    {
        return view('pages.mbo.index', array(
            'objectives' => ObjectiveTemplate::paginate(30),
            'nav' => $this->nav(),
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     */
    public function create(Request $request): Response
    {
        return view('components.forms.edit', array(
            'form' => ObjectiveTemplateEditForm::definition($request),
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param ObjectiveTemplateEditForm $form
     */
    public function store(Request $request, ObjectiveTemplateEditForm $form): Response
    {
        $request = $form::reformatRequest($request);
        $request->validate();

        $objective = ObjectiveTemplate::fillFromRequest($request);

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
    public function show($id): Response {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Request $request
     */
    public function edit(Request $request, $id): Response
    {
        $model = ObjectiveTemplate::findOrFail($id);

        return view('components.forms.edit', array(
            'objective' => $model,
            'form' => ObjectiveTemplateEditForm::definition($request, $model),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @param ObjectiveTemplateEditForm $form
     */
    public function update(Request $request, $id, ObjectiveTemplateEditForm $form): Response
    {
        $request = $form::reformatRequest($request);
        $form::validate($request, $id);
        $objective = ObjectiveTemplate::fillFromRequest($request, $id);
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
