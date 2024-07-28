<?php

namespace App\Http\Controllers\Management\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users\UsersDataTable;
use App\Http\Controllers\Management\ManagementController;

class OrganizationController extends ManagementController
{
    public function index()
    {
        return view('pages.management.organization.index', [
            'nav' => $this->nav,
        ]);
    }
}
