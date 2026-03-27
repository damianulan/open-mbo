<?php

namespace App\Http\Controllers\Settings\Organization;

use App\Http\Controllers\Settings\SettingsController;
use Illuminate\View\View;

class OrganizationController extends SettingsController
{
    public function index(): View
    {
        $this->addPageNav();

        return view('pages.settings.organization.index');
    }
}
