<?php

namespace App\Config;

use App\Enums\Core\EnvironmentType;
use Exception;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Stringable;

class Environment implements Stringable
{
    protected EnvironmentType $type;

    public function __construct()
    {
        try {
            $this->type = EnvironmentType::tryFrom(Config::get('app.env'));
        } catch (InvalidArgumentException $e) {
            throw new Exception('Invalid environment type set in env file.');
        }
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return app(static::class)->{$name}(...$arguments);
    }

    public function __toString(): string
    {
        return $this->type->value;
    }

    public function get(): EnvironmentType
    {
        return $this->type;
    }

    public function is(EnvironmentType|string $type): bool
    {
        $value = $type instanceof EnvironmentType ? $type->value : $type;

        return $this->type->value === $value;
    }
}
