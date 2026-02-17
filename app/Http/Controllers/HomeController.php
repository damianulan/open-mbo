<?php

namespace App\Http\Controllers;

use App\Support\Search\SearchEngine;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends AppController
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
     */
    public function index(): Renderable
    {
        $user = Auth::user();

        return view('pages.dashboard', [
            'user' => $user,
        ]);
    }
}
