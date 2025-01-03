<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MBO\Objective;
use App\Models\Core\User;
use App\Models\MBO\Campaign;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $objective = Objective::findOrFail($id);

        $header = 'Podsumowanie Celu';
        return view('pages.mbo.objectives.show', [
            'objective' => $objective,
            'pagetitle' => $header,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
