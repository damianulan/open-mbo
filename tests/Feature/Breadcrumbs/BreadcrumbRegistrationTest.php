<?php

namespace Tests\Feature\Breadcrumbs;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class BreadcrumbRegistrationTest extends TestCase
{
    public function test_registers_breadcrumbs_for_all_eligible_named_get_routes(): void
    {
        $ignoredRoutePrefixes = [
            'debugbar.',
            'ignition.',
            'livewire.',
            'sanctum.',
            'telescope',
            'boost.',
            'laraverse.',
        ];

        $namedRoutes = collect(Route::getRoutes()->getRoutesByName());

        $eligibleRouteNames = $namedRoutes
            ->filter(function ($route, string $routeName) use ($ignoredRoutePrefixes): bool {
                foreach ($ignoredRoutePrefixes as $prefix) {
                    if (str_starts_with($routeName, $prefix)) {
                        return false;
                    }
                }

                return in_array('GET', $route->methods(), true) || in_array('HEAD', $route->methods(), true);
            })
            ->keys()
            ->values();

        $routeParameterCounts = $namedRoutes
            ->mapWithKeys(static fn ($route, string $routeName): array => [$routeName => count($route->parameterNames())]);

        $resolveParent = static function (string $routeName) use ($eligibleRouteNames, $routeParameterCounts): ?string {
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

                if ( ! $eligibleRouteNames->contains($candidate)) {
                    continue;
                }

                if (($routeParameterCounts[$candidate] ?? 0) > 0) {
                    continue;
                }

                return $candidate;
            }

            return null;
        };

        $missingBreadcrumbs = $eligibleRouteNames
            ->filter(fn (string $routeName): bool => null !== $resolveParent($routeName))
            ->reject(fn (string $routeName): bool => Breadcrumbs::exists($routeName))
            ->values();

        $this->assertSame([], $missingBreadcrumbs->all(), 'Missing breadcrumbs for routes: ' . $missingBreadcrumbs->implode(', '));
    }
}
