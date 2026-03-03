<?php

namespace App\Http\Controllers;

use App\Support\UI\Page\Navigation\PageNav;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function __construct() {}

    protected function setPagetitle(string $title): void
    {
        Session::flash('pagetitle', $title);
    }

    protected function setPageNav(string $id, array $items): void
    {
        $nav = PageNav::boot($id, $items);

        Context::add('pagenav', $nav);
    }
}
