<?php

namespace App\Support\Search\Discovery;

use App\Support\Search\Factories\IndexResource;
use Lucent\Support\Magellan\MagellanScope;
use Lucent\Support\Magellan\Workshop\ScopeUsesCache;
use ReflectionClass;

class SearchResourceScope extends MagellanScope implements ScopeUsesCache
{
    public function ttl(): int
    {
        return 0;
    }

    protected function scope(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(IndexResource::class) && $class->isInstantiable();
    }
}
