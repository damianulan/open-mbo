<?php

namespace App\Support\Search\Discovery;

use App\Support\Search\Traits\HasIndex;
use Lucent\Support\Magellan\MagellanScope;
use Lucent\Support\Magellan\Workshop\ScopeUsesCache;

class SearchModelScope extends MagellanScope implements ScopeUsesCache
{

    protected function scope(\ReflectionClass $class): bool
    {
        return class_uses_trait(HasIndex::class, $class->getName()) && $class->isInstantiable();
    }

    public function ttl(): int
    {
        return 3600;
    }
}
