<?php

namespace App\Support\Page;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Lucent\Support\Dtos\LaravelDto;

class PageBuilder extends LaravelDto
{
    public function __construct(?string $pagetitle = null, bool $sidebar = true, bool $topbar_header = true)
    {
        $attributes['routename'] = Route::currentRouteName();

        $attributes['info'] = null;
        if (Lang::hasForLocale('menus.info.' . $attributes['routename'])) {
            $attributes['info'] = __('menus.info.' . $attributes['routename']);
        }

        $attributes['sitename'] = app(GeneralSettings::class)->site_name;
        $attributes['theme'] = current_theme();
        $attributes['locale'] = app(GeneralSettings::class)->locale;
        $attributes['logo'] = app(GeneralSettings::class)->site_logo;
        $attributes['topbar_header'] = $topbar_header;

        if (isset($_COOKIE['menu-collapsed']) && true === (bool) $_COOKIE['menu-collapsed']) {
            $attributes['sidebar_collapsed'] = 'menu-collapsed';
        }

        parent::__construct($attributes);

        if (empty($pagetitle)) {
            $this->setAttribute('title', $this->assignPageTitle($attributes['routename']));
        } else {
            $this->setAttribute('title', $pagetitle);
        }

        if($sidebar) {
            $this->setAttribute('sidebar', MenuBuilder::bootSidebar($this->getAttribute('sitename'))
                ->addClass($this->getAttribute('sidebar_collapsed')));

        }
    }

    private function assignPageTitle($routename)
    {
        return Lang::hasForLocale('menus.' . $routename) ? __('menus.' . $routename) : '';
    }
}
