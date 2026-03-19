<?php

namespace App\Support\UI\Page\Navigation;

use App\Support\UI\Page\Navigation\Contracts\NavbarContract;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TopBar implements NavbarContract
{
    protected ?string $breadcrumbs = null;

    public function __construct()
    {
        $breadcrumbs = Breadcrumbs::generate(Route::currentRouteName());

        if ($breadcrumbs->count() <= 1) {
            return;
        }

        $this->breadcrumbs = view(config('breadcrumbs.view'), compact('breadcrumbs'))->render();
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
