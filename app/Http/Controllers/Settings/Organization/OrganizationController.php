<?php

namespace App\Http\Controllers\Settings\Organization;

use App\Http\Controllers\Settings\SettingsController;

class OrganizationController extends SettingsController
{
    public function index()
    {
        return view('pages.settings.organization.index', array(
            'nav' => $this->nav(),
        ));
    }
}
