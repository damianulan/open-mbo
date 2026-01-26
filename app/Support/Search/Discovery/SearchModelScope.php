<?php

namespace App\Support\Search\Discovery;

use App\Support\Search\Traits\Searchable;
use Lucent\Support\Magellan\MagellanScope;
use Lucent\Support\Magellan\Workshop\ScopeUsesCache;
use ReflectionClass;

class SearchModelScope extends MagellanScope implements ScopeUsesCache
{
    public function ttl(): int
    {
        return 3600;
    }

    protected function scope(ReflectionClass $class): bool
    {
        return class_uses_trait(Searchable::class, $class->getName()) && $class->isInstantiable();
    }
}
