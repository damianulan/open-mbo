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

$registeredRoutes = $namedRoutes
    ->filter(function ($route, string $routeName) use ($shouldRegisterBreadcrumb): bool {
        if (! $shouldRegisterBreadcrumb($routeName)) {
            return false;
        }

        return in_array('GET', $route->methods(), true) || in_array('HEAD', $route->methods(), true);
    });

$registeredRouteNames = $registeredRoutes
    ->keys()
    ->values();

$routeParameterCounts = $registeredRoutes
    ->mapWithKeys(static fn ($route, string $routeName): array => [$routeName => count($route->parameterNames())]);

$routeKeyAliases = static function (string $routeName): array {
    $aliases = [$routeName];
    $normalizedRouteName = str_replace('-', '_', $routeName);

    if ($normalizedRouteName !== $routeName) {
        $aliases[] = $normalizedRouteName;
    }

    return array_values(array_unique($aliases));
};

$resolveTranslation = static function (array $translationKeys): ?string {
    foreach (array_unique($translationKeys) as $translationKey) {
        if (Lang::hasForLocale($translationKey)) {
            return __($translationKey);
        }
    }

    return null;
};

$fallbackLabel = static function (string $routeName): string {
    $segments = explode('.', $routeName);
    $lastSegment = end($segments);

    return Str::of(str_replace(['-', '_'], ' ', $lastSegment))
        ->title()
        ->toString();
};

$routeLabel = static function (string $routeName) use ($resolveTranslation, $routeKeyAliases, $fallbackLabel): string {
    $translation = $resolveTranslation(
        collect($routeKeyAliases($routeName))
            ->map(static fn (string $routeKey): string => 'menus.' . $routeKey)
            ->all(),
    );

    if ($translation !== null) {
        return $translation;
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

    return $fallbackLabel($routeName);
};

$aliasLabel = static function (string $routeAlias) use ($resolveTranslation, $routeKeyAliases, $fallbackLabel): string {
    $translation = $resolveTranslation(
        collect($routeKeyAliases($routeAlias))
            ->flatMap(static fn (string $routeKey): array => [
                'menus.' . $routeKey . '.index',
                'menus.' . $routeKey,
            ])
            ->all(),
    );

    if ($translation !== null) {
        return $translation;
    }

    return $fallbackLabel($routeAlias);
};

$routeUrl = static function (string $routeName): ?string {
    $route = Route::getRoutes()->getByName($routeName);

    if ($route === null) {
        return null;
    }

    $parameters = [];

    foreach ($route->parameterNames() as $parameterName) {
        $parameterValue = request()->route($parameterName);

        if ($parameterValue === null) {
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

$routeAliases = static function (string $routeName): array {
    $parts = explode('.', $routeName);
    $parts = array_slice($parts, 0, -1);

    $aliases = [];

    for ($length = 1; $length <= count($parts); $length++) {
        $aliases[] = implode('.', array_slice($parts, 0, $length));
    }

    return $aliases;
};

$resolveAliasRouteName = static function (string $routeAlias) use ($registeredRouteNames, $routeParameterCounts): ?string {
    foreach ([$routeAlias . '.index', $routeAlias] as $candidate) {
        if (! $registeredRouteNames->contains($candidate)) {
            continue;
        }

        if (($routeParameterCounts[$candidate] ?? 0) > 0) {
            continue;
        }

        return $candidate;
    }

    return null;
};

$breadcrumbItems = static function (string $routeName) use (
    $aliasLabel,
    $resolveAliasRouteName,
    $routeAliases,
    $routeLabel,
    $routeUrl
): array {
    $aliases = $routeAliases($routeName);
    $items = [];
    $isIndexRoute = str_ends_with($routeName, '.index');

    foreach ($aliases as $index => $routeAlias) {
        $resolvedRouteName = $resolveAliasRouteName($routeAlias);
        $isCurrentItem = $isIndexRoute && $index === array_key_last($aliases);

        $items[] = [
            'title' => $aliasLabel($routeAlias),
            'url' => $isCurrentItem || $resolvedRouteName === null ? null : $routeUrl($resolvedRouteName),
        ];
    }

    if ($items === [] || ! $isIndexRoute) {
        $items[] = [
            'title' => $routeLabel($routeName),
            'url' => null,
        ];
    }

    return $items;
};

foreach ($registeredRouteNames as $routeName) {
    Breadcrumbs::for($routeName, function (BreadcrumbTrail $trail) use ($breadcrumbItems, $routeName): void {
        foreach ($breadcrumbItems($routeName) as $item) {
            if ($item['url'] !== null) {
                $trail->push($item['title'], $item['url']);

                continue;
            }

            $trail->push($item['title']);
        }
    });
}
