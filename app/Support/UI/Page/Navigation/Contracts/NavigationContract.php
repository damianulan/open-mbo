<?php

namespace App\Support\UI\Page\Navigation\Contracts;

interface NavigationContract
{
    public function hasSidebar(): bool;

    public function isSidebarCollapsed(): bool;
}
