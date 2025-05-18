<?php

namespace App\Http\Controllers\Management\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\ManagementController;

class OrganizationController extends ManagementController
{
    public function index()
    {
        return view('pages.management.organization.index', [
            'nav' => $this->nav(),
        ]);
    }
}
