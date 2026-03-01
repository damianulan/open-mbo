<?php

namespace App\Support\UI\Page;

use App\Settings\GeneralSettings;
use App\Support\UI\Page\Navigation\SidebarMenu;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class PageBuilder
{
    public ?string $routename = null;

    public ?string $info = null;

    public string $sitename = '';

    public string $theme = '';

    public string $locale = '';

    public ?string $logo = null;

    public bool $topbar_header = true;

    public string $sidebar_collapsed = '';

    public string $title = '';

    public ?SidebarMenu $sidebar = null;

    public function __construct(?string $pagetitle = null, bool $sidebar = true, bool $topbar_header = true)
    {
        $this->routename = Route::currentRouteName();

        $this->info = null;
        if (Lang::hasForLocale('menus.info.' . $this->routename)) {
            $this->info = __('menus.info.' . $this->routename);
        }

        $this->sitename = app(GeneralSettings::class)->site_name;
        $this->theme = current_theme();
        $this->locale = app(GeneralSettings::class)->locale;
        $this->logo = app(GeneralSettings::class)->site_logo;
        $this->topbar_header = $topbar_header;

        if (isset($_COOKIE['menu-collapsed']) && true === (bool) $_COOKIE['menu-collapsed']) {
            $this->sidebar_collapsed = 'menu-collapsed';
        }

        if (empty($pagetitle)) {
            $this->title = $this->assignPageTitle($this->routename);
        } else {
            $this->title = $pagetitle;
        }

        if ($sidebar) {
            $this->sidebar = MenuBuilder::bootSidebar($this->sitename)
                ->addClass($this->sidebar_collapsed);

        }
    }

    private function assignPageTitle(?string $routename): string
    {
        return Lang::hasForLocale('menus.' . $routename) ? __('menus.' . $routename) : '';
    }
}
