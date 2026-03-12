<?php

namespace App\Support\UI\Page\Navigation;

use App\Settings\GeneralSettings;
use App\Support\UI\Page\Navigation\Contracts\NavigationContract;
use App\Warden\PermissionsLib;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Route;

class NavigationService implements NavigationContract
{
    protected bool $authenticated = false;

    private $sitename;

    private ?SidebarNav $sidebar = null;

    private ?TopBar $topbar = null;

    public function __construct()
    {
        $this->sitename = app(GeneralSettings::class)->site_name ?: null;
        $this->authenticated = Auth::check();

        $this->buildSidebar();
        $this->buildTopbar();
    }

    public function hasSidebar(): bool
    {
        return $this->sidebar && $this->sidebar->hasItems();
    }

    public function hasTopbar(): bool
    {
        return $this->topbar instanceof TopBar;
    }

    public function isSidebarCollapsed(): bool
    {
        return $this->hasSidebar() && $this->sidebar->isCollapsed();
    }

    public function renderSidebar(): string
    {
        return $this->hasSidebar() ? $this->sidebar->render() : '';
    }

    public function renderTopbar(): string
    {
        return $this->hasTopbar() ? $this->topbar->render() : '';
    }

    // PAGENAV

    public function hasPageNav(): bool
    {
        return Context::has('pagenav');
    }

    public function getPageNav(): PageNav
    {
        return Context::pull('pagenav');
    }

    public function renderPageNav(): string
    {
        return $this->hasPageNav() ? $this->getPageNav()->render() : '';
    }

    protected function validateSidebar(): bool
    {
        return ! Route::is('auth.*') && $this->authenticated;
    }

    protected function validateTopbar(): bool
    {
        return $this->authenticated;
    }

    private function buildSidebar(): void
    {
        if ( ! $this->validateSidebar()) {
            return;
        }
        $this->sidebar = SidebarNav::boot($this->sitename, [
            MenuItem::make('dashboard')
                ->setTitle(__('menus.dashboard'))
                ->setIcon('grid-fill')
                ->setRoute('dashboard'),
            MenuItem::make('objectives')
                ->setTitle(__('menus.my_objectives.index'))
                ->setIcon('clipboard-check-fill')
                ->setRoute('my-objectives.index'),
            MenuItem::make('campaign')
                ->setTitle(__('menus.campaigns.index'))
                ->setIcon('bullseye')
                ->setRoute('campaigns.index')
                ->settings('mbo.campaigns_enabled', 'mbo.enabled')
                ->permission('mbo-campaign-*'),
            MenuItem::make('mbo')
                ->setTitle(__('menus.mbo.index'))
                ->setIcon('crosshair')
                ->setRoute('objectives.index')
                ->permission('mbo-*'),
            // MenuItem::make('reports')
            //     ->setTitle(__('menus.reports.index'))
            //     ->setIcon('bar-chart-steps')
            //     ->setRoute('reports.index'),
            MenuItem::make('users')
                ->setTitle(__('menus.users.index'))
                ->setIcon('person-fill')
                ->permission(PermissionsLib::USERS_LIST)
                ->setRoute('users.index'),

            MenuItem::make('settings')
                ->setTitle(__('menus.settings.index'))
                ->setIcon('gear-fill')
                ->permission('settings-*')
                ->setRoute('settings.general.index'),
        ]);
    }

    private function buildTopbar(): void
    {
        if ( ! $this->validateTopbar()) {
            return;
        }

        $this->topbar = new TopBar();
    }
}
