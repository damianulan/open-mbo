<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\Elearning\Courses\CourseEditForm;
use App\Models\Elearning\Course;
use App\DataTables\Elearning\CoursesDataTable;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $type)
    {
        $pagetype = $type==='list' ? 'list-view':'tile-view';
        if($type === 'list'){
            $dataTable = new CoursesDataTable();
            return $dataTable->render('pages.courses.index', [
                'type' => $pagetype,
            ]);
        }
        $courses = Course::getCatalog();
        return view('pages.courses.index', [
            'courses' => $courses,
            'type' => $pagetype,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.courses.edit', [
            'form' => CourseEditForm::boot(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CourseEditForm $form)
    {
        $request->validate($form::validation());
        $course = Course::fillFromRequest($request);
        if($course->save()){ // todo redirect do utworzonego id
            return redirect()->back()->with('success', __('alerts.courses.success.create', ['coursetitle' => $course->title]));
        }
        return redirect()->back()->with('error', __('alerts.courses.error.create', ['coursetitle' => $course->title]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if($course){
            return view('pages.courses.view', [
                'pagetitle' => $course->title,
                'course' => $course
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        return view('pages.courses.edit', [
            'form' => CourseEditForm::boot($course),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, CourseEditForm $form)
    {
        $request->validate($form::validation());
        $course = Course::fillFromRequest($request, $id);
        if($course->update()){
            return redirect()->back()->with('success', __('alerts.courses.success.update', ['coursetitle' => $course->title]));
        }
        return redirect()->back()->with('error', __('alerts.courses.error.update', ['coursetitle' => $course->title]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function toggleVisibility(string $id)
    {
        $course = Course::find($id);
        if($course){
            if($course->visible == 1){
                $course->visible = 0;
            } else {
                $course->visible = 1;
            }
            if($course->update()){
                return redirect()->back()->with('success', __('alerts.courses.success.hide', ['coursetitle' => $course->title]));
            }
        }
        return redirect()->back()->with('error', __('alerts.courses.error.hide', ['coursetitle' => $course->title]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        if($course){
            if($course->delete())
            {
                return redirect()->back()->with('success', __('alerts.courses.success.delete', ['coursetitle' => $course->title]));
            }
        }
        return redirect()->back()->with('error', __('alerts.courses.error.delete', ['coursetitle' => $course->title]));
    }
}
