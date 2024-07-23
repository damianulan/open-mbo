<?php

namespace App\Http\Controllers\Management\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users\UsersDataTable;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('pages.management.organization.index', [

        ]);
    }
}
