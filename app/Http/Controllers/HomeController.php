<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends AppController
{
    public function index(Request $request): View
    {
        return view('pages.dashboard', [
            'user' => $request->user(),
        ]);
    }
}
