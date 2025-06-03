<?php

namespace App\Http\Controllers\Settings\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Settings\SettingsController;

class OrganizationController extends SettingsController
{
    public function index()
    {
        return view('pages.settings.organization.index', [
            'nav' => $this->nav(),
        ]);
    }
}
