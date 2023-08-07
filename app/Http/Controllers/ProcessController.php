<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBO\Process;
use App\Models\MBO\Objective;
use App\Enums\ProcessStage;
use App\Forms\MBO\ProcessEditForm;

class ProcessController extends Controller
{
    public function index()
    {
        return view('pages.process.index', [

        ]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.process.edit', [
            'form' => ProcessEditForm::boot(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProcessEditForm $form)
    {
        $request->validate($form::validation());
        $process = Process::fillFromRequest($request);
        if($process->save()){

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.process.show', [
            'process' => Process::findOrFail($id),
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
        $model = Process::findOrFail($id);
        return view('pages.process.edit', [
            'process' => $model,
            'form' => ProcessEditForm::boot($model),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
