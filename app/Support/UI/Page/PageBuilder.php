<?php

namespace App\Support\UI\Page;

use App\Settings\GeneralSettings;
use App\Support\UI\Page\Contracts\PageContract;
use App\Support\UI\Page\Navigation\Contracts\NavigationContract;
use App\Support\UI\Theme\Theme;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Throwable;

class PageBuilder implements PageContract
{
    public ?string $routename = null;

    public ?string $info = null;

    public string $sitename = '';

    public Theme $theme;

    public string $locale = '';

    public ?string $logo = null;

    public string $title = '';

    public function __construct()
    {
        $this->routename = Route::currentRouteName();

        $this->sitename = app(GeneralSettings::class)->site_name;
        $this->theme = app(Theme::class);
        $this->locale = app(GeneralSettings::class)->locale ?? config('app.fallback_locale');
        $this->logo = app(GeneralSettings::class)->site_logo;

        $this->assignPageTitle($this->routename);
    }

    public function getNavigation(): ?NavigationContract
    {
        try {
            $contract = app(NavigationContract::class);

            return $contract;
        } catch (Throwable $th) {

        }

        return null;
    }

    public function getSiteTitle(): string
    {
        return $this->sitename . ' - ' . $this->getPageTitle();
    }

    public function getThemeName(): string
    {
        return $this->theme?->current ?: '';
    }

    public function getThemeMode(): string
    {
        return $this->theme?->mode ?: 'light';
    }

    public function getThemePath(): string
    {
        return asset('themes/' . $this->getThemeName() . '/app.min.css');
    }

    public function getFaviconPath(): string
    {
        return asset('images/resources/favicon.ico');
    }

    public function getMainContentClasses(): string
    {
        $classes = [];
        if ($this->getNavigation()?->hasSidebar()) {
            $classes[] = 'content';
            if ($this->getNavigation()?->isSidebarCollapsed()) {
                $classes[] = 'collapsed';
            }

        }

        return implode(' ', $classes);
    }

    public function getPageTitle(): string
    {
        return $this->title;
    }

    public function setPagetitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    private function assignPageTitle(?string $routename): void
    {
        $this->title = Lang::hasForLocale('menus.' . $routename) ? __('menus.' . $routename) : '';
        if (Lang::hasForLocale('menus.info.' . $this->routename)) {
            $this->info = __('menus.info.' . $this->routename);
        }
    }
}
