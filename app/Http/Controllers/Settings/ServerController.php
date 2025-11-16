<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\SmtpForm;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ServerController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $git_text = __('globals.no_data');
        if ( ! empty(config('app.head'))) {
            $git_text = 'On branch <strong>' . config('app.head') . '</strong>';
        }

        $model = app(MailSettings::class); // ->safePassword();

        return view('pages.settings.server', [
            'git_text' => $git_text,
            'mail' => $model,
            'form' => SmtpForm::definition($request, $model),
            'nav' => $this->nav(),
        ]);
    }

    public function storeMail(Request $request, MailSettings $settings)
    {
        $request->validate([
            'mail_port' => 'numeric',
            'mail_from_address' => 'email',
            'mail_catchall_receiver' => 'email',
        ]);
        foreach ($request->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->back()->with('success', __('alerts.settings.success.mail_update'));
        }

        return redirect()->back()->with('error', __('alerts.settings.error.mail_update'));
    }

    public function cache()
    {
        $command = Artisan::call('optimize:clear');

        if (0 === $command) {
            return redirect()->back()->with('success', __('alerts.settings.success.cache_clear'));
        }

        $msg = __('alerts.settings.error.cache_clear');
        if (config('app.debug')) {
            $msg .= '<br/>' . str_replace("\n", '<br/>', Artisan::output());
        }

        return redirect()->back()->with('error', $msg);
    }

    public function debugging(Request $request, GeneralSettings $settings)
    {
        $response = false;
        $check = filter_var($request->input('check'), FILTER_VALIDATE_BOOLEAN);
        $settings->debug = $check;
        if ($settings->save()) {
            $response = true;
        }

        return response()->json($response);
    }

    public function debugbar(Request $request, GeneralSettings $settings)
    {
        $response = false;
        $check = filter_var($request->input('check'), FILTER_VALIDATE_BOOLEAN);
        $settings->debugbar = $check;
        if ($settings->save()) {
            $response = true;
        }

        return response()->json($response);
    }
}
