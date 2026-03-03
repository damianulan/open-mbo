<?php

namespace App\Support\UI\Page\Navigation;

use App\Support\UI\Page\Navigation\Contracts\NavbarContract;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TopBar implements NavbarContract
{
    protected $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = Breadcrumbs::render(Route::currentRouteName());
    }

    public function render(): string
    {
        return view('layouts.portal.topbar', [
            'page' => app('page'),
            'user' => Auth::user(),
            'breadcrumbs' => $this->breadcrumbs,
        ])->render();
    }
}
