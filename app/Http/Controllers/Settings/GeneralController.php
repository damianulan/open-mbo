<?php

namespace App\Http\Controllers\Settings;

use App;
use App\Forms\Settings\GeneralForm;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use App\Jobs\Core\AppUpdateAdhoc;

class GeneralController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $model = app(GeneralSettings::class);

        return view('pages.settings.index', [
            'model' => $model,
            'form' => GeneralForm::definition($request, $model),
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
        $target_release = settings('general.target_release');
        foreach ($request->all() as $key => $value) {
            $settings->$key = $value;
        }
        if ($settings->save()) {
            if ($settings->target_release !== $target_release) {
                AppUpdateAdhoc::dispatch();
            }
            return redirect()->back()->with('success', __('alerts.settings.success.general'));
        }

        return redirect()->back()->with('error', __('alerts.settings.error.general'));
    }
}
