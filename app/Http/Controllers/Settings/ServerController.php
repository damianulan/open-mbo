<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\app\Git;

class ServerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $debugging_text = '<span class="text-success">'. __('vocabulary.turned_off_male') .'</span>';
        if(config('app.debug') === true){
            $debugging_text = '<span class="text-warning">'. __('vocabulary.turned_on_male') .'</span>';
        }

        $git_text = __('vocabulary.no_data');
        if(Git::head() && Git::branch() && Git::url()){
            $git_text = 'On branch ' . Git::branch() . ' ('. Git::head() . ') from repo <a href="'. Git::url() .'" class="btn btn-primary">'. Git::url() .'</a>';
        }

        return view('pages.settings.server', [
            'title' => __('menus.settings.index') . ' - ' . __('menus.settings.server'),
            'debugging_text' => $debugging_text,
            'git_text' => $git_text,
        ]);
    }

    public function cache()
    {
        $command = Artisan::call('optimize:clear');
        if($command){
            return redirect()->back()->with('success', 'Application caches cleared successfully!');
        }
        return redirect()->back()->with('error', "Unable to clear cache! Check server permissions.");
    }
}