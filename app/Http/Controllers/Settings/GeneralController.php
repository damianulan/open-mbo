<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\GeneralForm;
use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class GeneralController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $model = app(GeneralSettings::class);
        return view('pages.settings.index', [
            'model' => $model,
            'form' => GeneralForm::definition($model),
            'nav' => $this->nav(),
        ]);
    }

    public function storeGeneral(Request $request, GeneralSettings $settings)
    {
        $request->validate([
            'site_name' => 'min:3|max:16|required',
            'theme' => 'required',
            'locale' => 'required',
        ]);
        foreach ($request->all() as $key => $value) {
            $settings->$key = $value;
        }
        if ($settings->save()) {
            return redirect()->back()->with('success', __('alerts.settings.success.general'));
        }
        return redirect()->back()->with('error', __('alerts.settings.error.general'));;
    }
}
