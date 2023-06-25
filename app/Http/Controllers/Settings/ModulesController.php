<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\Modules\ModuleManager;
use App\Facades\Modules\ModuleModel;
use Illuminate\Support\Facades\Artisan;

class ModulesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.settings.modules', [
            'modules' => ModuleManager::get(),
        ]);
    }

    public function updateStatus(Request $request)
    {
        $response = false;
        $module = ModuleModel::find($request->input('id'));
        if(!empty($module)){
            $module->active = (bool) $request->input('active');
            $response = $module->update();
            if($response){
                Artisan::call('config:cache');
            }
        }

        return response()->json($response);
    }
}