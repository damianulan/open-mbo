<?php

namespace App\Http\Controllers;

use App\Support\Search\IndexModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use App\Support\Search\SearchEngine;
use App\Support\Search\Factories\ModelResourceFactory;
use App\Support\Search\Jobs\SearchIndexJob;

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
        // $input = 'ds.';
        // $engine = new SearchEngine($input);
        // $results = $engine->get();
        // $paginator = $engine->getPaginator();
        // dd($results, $paginator);

        $user = Auth::user();

        return view('pages.dashboard', array(
            'user' => $user,
        ));
    }
}
