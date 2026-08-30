<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modularis\Repositories\FilesRepository;

class HomeController extends AppController
{
    public function index(Request $request): View
    {
        return view('pages.dashboard', [
            'user' => $request->user(),
        ]);
    }

    public function debug(): RedirectResponse
    {
        dd(app(FilesRepository::class));

        return redirect()->route('dashboard');
    }
}
