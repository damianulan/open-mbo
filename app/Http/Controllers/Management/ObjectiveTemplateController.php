<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forms\MBO\ObjectiveTemplateEditForm;
use App\Models\MBO\ObjectiveTemplate;

class ObjectiveTemplateController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('pages.management.index', [
            'objectives' => ObjectiveTemplate::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.management.objectives.edit', [
            'form' => ObjectiveTemplateEditForm::boot()
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
        $request->validate($form::validation());
        $objective = ObjectiveTemplate::fillFromRequest($request);

        if($objective->save()){
            return redirect()->route('management.objectives.index')->with('success', __('alerts.objective_template.success.create'));
        }
        return redirect()->back()->with('error', 'Wystąpił błąd.');
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
    public function edit($id)
    {
        $model = ObjectiveTemplate::findOrFail($id);
        return view('pages.management.objectives.edit', [
            'objective' => $model,
            'form' => ObjectiveTemplateEditForm::boot($model),
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
        $request->validate($form::validation());
        $objective = ObjectiveTemplate::fillFromRequest($request, $id);
        if($objective->update()){
            return redirect()->route('management.objectives.index')->with('success', __('alerts.objective_template.success.edit'));
        }
        return redirect()->back()->with('error', 'Wystąpił błąd.');
    }

    public function delete($id)
    {
        $objective = ObjectiveTemplate::findOrFail($id);
        if($objective->delete()){
            return redirect()->route('management.objectives.index')->with('success', __('alerts.objective_template.success.delete'));
        }
        return redirect()->back()->with('error', 'Wystąpił błąd.');
    }

}
