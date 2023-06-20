<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\Elearning\Courses\CourseEditForm;
use App\Models\Elearning\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.courses.index', [
            'courses' => Course::getCatalog(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.courses.create', [
            'form' => CourseEditForm::boot(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CourseEditForm $form)
    {
        $request->validate($form::validation());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.courses.view', [
            'pagetitle' => 'Kurs przykładowy',
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
