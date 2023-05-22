<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        if( !empty(config('app.head')) ){
            $git_text = 'On branch <strong>' . config('app.head') . '</strong>' ;
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

        if($command === 0){
            return redirect()->back()->with('success', __('alerts.success.cache_clear'));
        }

        $msg = __('alerts.error.cache_clear');
        if(config('app.debug')){
            $msg .= "<br/>" . str_replace("\n", "<br/>", Artisan::output());
        }
        return redirect()->back()->with('error', $msg);
    }
}