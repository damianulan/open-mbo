<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Settings\MailSettings;
use App\Forms\Settings\SmtpForm;

class ServerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $git_text = __('vocabulary.no_data');
        if( !empty(config('app.head')) ){
            $git_text = 'On branch <strong>' . config('app.head') . '</strong>' ;
        }

        $model = app(MailSettings::class); //->safePassword();
        return view('pages.settings.server', [
            'git_text' => $git_text,
            'mail' => $model,
            'form' => SmtpForm::boot($model),
        ]);
    }

    public function storeMail(Request $request, MailSettings $settings)
    {
        $request->validate([
            'mail_host' => 'max:5',
            'mail_port' => 'numeric',
            'mail_from_address' => 'email',
        ]);
        foreach($request->all() as $key => $value){
            $settings->$key = $value;
        }
        if($settings->save()){
            return redirect()->back()->with('success', __('alerts.settings.success.mail_update'));
        }
        return redirect()->back()->with('error', __('alerts.settings.error.mail_update'));;
    }

    public function cache()
    {
        $command = Artisan::call('optimize:clear');

        if($command === 0){
            return redirect()->back()->with('success', __('alerts.settings.success.cache_clear'));
        }

        $msg = __('alerts.settings.error.cache_clear');
        if(config('app.debug')){
            $msg .= "<br/>" . str_replace("\n", "<br/>", Artisan::output());
        }
        return redirect()->back()->with('error', $msg);
    }
}