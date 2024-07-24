<?php

namespace App\Facades\Page;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;
use App\Facades\Page\Bars\SidebarMenu;
use App\Facades\Page\MenuBuilder;

class PageBuilder
{
    public $routename;
    public $sitename;
    public $title;
    public $info;
    public $theme;
    public $locale;
    public $logo;
    public $sidebar_collapsed = null;
    public SidebarMenu $sidebar;

    public function __construct(?string $pagetitle = null)
    {
        $this->routename = Route::currentRouteName();

        if(empty($pagetitle)){
            $this->title = $this->assignPageTitle();
        } else {
            $this->title = $pagetitle;
        }
        $this->info = null;
        if(Lang::hasForLocale('menus.info.'.$this->routename)){
            $this->info = __('menus.info.'.$this->routename);
        }

        $this->sitename = app(GeneralSettings::class)->site_name;
        $this->theme = app(GeneralSettings::class)->theme;
        $this->locale = app(GeneralSettings::class)->locale;
        $this->logo = app(GeneralSettings::class)->site_logo;

        if(isset($_COOKIE['menu-collapsed']) && (bool) $_COOKIE['menu-collapsed']===true){
            $this->sidebar_collapsed = 'menu-collapsed';
        }

        $this->sidebar = MenuBuilder::bootSidebar($this->sitename)
                            ->addClass($this->sidebar_collapsed);
    }

    private function assignPageTitle()
    {
        return __('menus.'.$this->routename);
    }


}
