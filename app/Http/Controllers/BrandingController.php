<?php

namespace App\Http\Controllers;

use App\Forms\Settings\BrandingForm;
use App\Settings\GeneralSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandingController extends AppController
{
    public function form(): void
    {
    }

    public function store(Request $request, GeneralSettings $settings, BrandingForm $form): RedirectResponse
    {
        $form->validate();
        $uploadedLogo = $request->file('site_logo');
        $location = null;

        if ($uploadedLogo) {
            $filename = 'logo.' . $uploadedLogo->getClientOriginalExtension();
            $storedPath = Storage::disk('uploads')->putFileAs('branding', $uploadedLogo, $filename);
            $location = $storedPath ? 'uploads/' . $storedPath : null;
        }

        $settings->site_logo = $location;

        if ($settings->save()) {
            return redirect()->back()->with('success', __('alerts.settings.success.general'));
        }

        return redirect()->back()->with('error', __('alerts.settings.error.general'));
    }
}
