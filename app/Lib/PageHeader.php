<?php

namespace App\Lib;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class PageHeader
{

    public $sitename;
    public $title;
    public $theme;
    public $locale;
    public $logo;
    public $menu_collapsed;

    public function __construct(?string $pagetitle = null)
    {
        if(empty($pagetitle)){
            $this->title = $this->assignPageTitle(Route::currentRouteName());
        } else {
            $this->title = $pagetitle;
        }

        $this->sitename = app(GeneralSettings::class)->site_name;
        $this->theme = app(GeneralSettings::class)->theme;
        $this->locale = app(GeneralSettings::class)->locale;
        $this->logo = app(GeneralSettings::class)->site_logo;

        if(isset($_COOKIE['menu-collapsed']) && (bool) $_COOKIE['menu-collapsed']===true){
            $this->menu_collapsed = 'menu-collapsed';
        }
    }

    private function assignPageTitle($route)
    {
        return __('menus.'.$route);
    }


}