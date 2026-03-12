<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$namedRoutes = collect(Route::getRoutes()->getRoutesByName());

$ignoredRoutePrefixes = [
    'debugbar.',
    'ignition.',
    'livewire.',
    'sanctum.',
    'telescope',
    'boost.',
    'laraverse.',
];

$shouldRegisterBreadcrumb = static function (string $routeName) use ($ignoredRoutePrefixes): bool {
    foreach ($ignoredRoutePrefixes as $prefix) {
        if (str_starts_with($routeName, $prefix)) {
            return false;
        }
    }

    return true;
};

$registeredRouteNames = $namedRoutes
    ->keys()
    ->filter(fn (string $routeName): bool => $shouldRegisterBreadcrumb($routeName))
    ->values();

$routeParameterCounts = $namedRoutes
    ->mapWithKeys(static fn ($route, string $routeName): array => [$routeName => count($route->parameterNames())]);

$hasMenuTranslation = static fn (string $routeName): bool => Lang::hasForLocale('menus.' . $routeName);

$routeLabel = static function (string $routeName) use ($hasMenuTranslation): string {
    if ($hasMenuTranslation($routeName)) {
        return __('menus.' . $routeName);
    }

    $segments = explode('.', $routeName);
    $lastSegment = end($segments);

    $verbs = [
        'index' => [
            'en' => 'List',
            'pl' => 'Lista',
        ],
        'create' => [
            'en' => 'Create',
            'pl' => 'Tworzenie',
        ],
        'edit' => [
            'en' => 'Edit',
            'pl' => 'Edycja',
        ],
        'show' => [
            'en' => 'Details',
            'pl' => 'Szczegóły',
        ],
        'delete' => [
            'en' => 'Delete',
            'pl' => 'Usuwanie',
        ],
    ];

    if (array_key_exists($lastSegment, $verbs)) {
        $locale = app()->getLocale();
        $fallbackLabel = $verbs[$lastSegment]['en'];

        return $verbs[$lastSegment][$locale] ?? $fallbackLabel;
    }

    return Str::of($lastSegment)
        ->replace('_', ' ')
        ->title()
        ->toString();
};

$routeUrl = static function (string $routeName): ?string {
    $route = Route::getRoutes()->getByName($routeName);

    if (null === $route) {
        return null;
    }

    $parameters = [];

    foreach ($route->parameterNames() as $parameterName) {
        $parameterValue = request()->route($parameterName);

        if (null === $parameterValue) {
            return null;
        }

        $parameters[$parameterName] = $parameterValue;
    }

    try {
        return route($routeName, $parameters);
    } catch (Throwable) {
        return null;
    }
};

$resolveParent = static function (string $routeName) use ($registeredRouteNames, $routeParameterCounts): ?string {
    if ('dashboard' === $routeName) {
        return null;
    }

    $parts = explode('.', $routeName);
    $lastPart = end($parts);
    $parentCandidates = [];

    if ('index' !== $lastPart && count($parts) > 1) {
        $base = implode('.', array_slice($parts, 0, -1));
        $parentCandidates[] = $base . '.index';
    }

    for ($length = count($parts) - 1; $length >= 1; $length--) {
        $parentCandidates[] = implode('.', array_slice($parts, 0, $length)) . '.index';
    }

    $parentCandidates[] = 'dashboard';

    foreach (array_unique($parentCandidates) as $candidate) {
        if ($candidate === $routeName) {
            continue;
        }

        if ( ! $registeredRouteNames->contains($candidate)) {
            continue;
        }

        if (($routeParameterCounts[$candidate] ?? 0) > 0) {
            continue;
        }

        return $candidate;
    }

    return null;
};

foreach ($registeredRouteNames as $routeName) {
    $parentRouteName = $resolveParent($routeName);

    if (null === $parentRouteName) {
        continue;
    }

    Breadcrumbs::for($routeName, function (BreadcrumbTrail $trail) use ($routeName, $parentRouteName, $routeLabel, $routeUrl): void {
        $trail->parent($parentRouteName);

        $label = $routeLabel($routeName);
        $url = $routeUrl($routeName);

        if (null !== $url) {
            $trail->push($label, $url);

            return;
        }

        $trail->push($label);
    });
}
