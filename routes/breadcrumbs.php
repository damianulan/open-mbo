<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// MANAGEMENT
Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail) {
    $trail->push(__('menus.management.index'));
});

Breadcrumbs::for('management.organization.index', function (BreadcrumbTrail $trail) {
    $trail->parent('management.index');
    $trail->push(__('menus.management.organization.index'), route('management.organization.index'));
});
