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
        // $models = $engine->get()->map(fn (IndexModel $index) => $index->source->employment);
        // $resources = $engine->get()->map(fn (IndexModel $index) => ModelResourceFactory::getResource($index->source)?->attributes());
        // dd($resources);

        $user = Auth::user();

        return view('pages.dashboard', array(
            'user' => $user,
        ));
    }
}
