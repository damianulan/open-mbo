<?php

namespace App\Lib;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Route;

class PageHeader
{

    public $routename;
    public $sitename;
    public $title;
    public $theme;
    public $locale;
    public $logo;
    public $menu_collapsed;

    public function __construct(?string $pagetitle = null)
    {
        $this->routename = Route::currentRouteName();

        if(empty($pagetitle)){
            $this->title = $this->assignPageTitle();
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

    private function assignPageTitle()
    {
        return __('menus.'.$this->routename);
    }


}
