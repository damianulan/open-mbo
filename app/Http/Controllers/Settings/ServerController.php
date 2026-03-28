<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\SmtpForm;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class ServerController extends SettingsController
{
    public function index(): View
    {
        $gitText = __('globals.no_data');

        if (! empty(config('app.head'))) {
            $gitText = 'On branch <strong>' . config('app.head') . '</strong>';
        }

        $this->addPageNav();

        $model = app(MailSettings::class);

        return view('pages.settings.server', [
            'git_text' => $gitText,
            'mail' => $model,
            'form' => SmtpForm::bootWithAttributes($model->toArray())->getDefinition(),
        ]);
    }

    public function storeMail(Request $request, MailSettings $settings): RedirectResponse
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

    public function cache(): RedirectResponse
    {
        $command = Artisan::call('optimize:clear');

        if ($command === 0) {
            return redirect()->back()->with('success', __('alerts.settings.success.cache_clear'));
        }

        $message = __('alerts.settings.error.cache_clear');

        if (config('app.debug')) {
            $message .= '<br/>' . str_replace("\n", '<br/>', Artisan::output());
        }

        return redirect()->back()->with('error', $message);
    }

    public function debugging(Request $request, GeneralSettings $settings): JsonResponse
    {
        $settings->debug = $request->boolean('check');

        return response()->json($settings->save());
    }

    public function debugbar(Request $request, GeneralSettings $settings): JsonResponse
    {
        $settings->debugbar = $request->boolean('check');

        return response()->json($settings->save());
    }
}
