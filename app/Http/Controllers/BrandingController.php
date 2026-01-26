<?php

namespace App\Http\Controllers;

use App\Forms\Settings\BrandingForm;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandingController extends AppController
{
    public function form(): void {}

    public function store(Request $request, GeneralSettings $settings, BrandingForm $form)
    {

        $form->validate();
        $tmp = $request->file('site_logo');
        $location = null;

        if ($tmp) {
            $filename = 'logo.' . $tmp->getClientOriginalExtension();
            $location = Storage::disk('uploads')->putFileAs('branding', $tmp, $filename);

            $location = $location ? 'uploads/' . $location : null;
            if ($location) {
                $settings->site_logo = 'uploads/' . $location;
                $settings->save();
            }
        }

        $settings->site_logo = $location;

        if ($settings->save()) {
            return redirect()->back()->with('success', __('alerts.settings.success.general'));
        }

        return redirect()->back()->with('error', __('alerts.settings.error.general'));
    }
}
