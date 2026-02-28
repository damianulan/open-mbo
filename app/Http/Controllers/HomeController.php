<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends AppController
{
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
