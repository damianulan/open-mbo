<?php

namespace App\Http\Controllers\Settings\Organization;

use App\Http\Controllers\Settings\SettingsController;

class OrganizationController extends SettingsController
{
    public function index()
    {
        $this->addPageNav();

        return view('pages.settings.organization.index');
    }
}
