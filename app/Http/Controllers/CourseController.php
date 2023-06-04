<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses\Course;

class CourseController extends Controller
{
    public function index()
    {
        
    }

    public function view($id = 0)
    {
        return view('pages.courses.view', [
            'pagetitle' => 'Kurs przykładowy',
        ]);
    }

    public function edit($id)
    {

    }
}