<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Models\Elearning\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::orderByDesc('available_from')->take(4)->get() ?? null;
        return view('pages.dashboard', [
            'courses' => $courses,
        ]);
    }
}
