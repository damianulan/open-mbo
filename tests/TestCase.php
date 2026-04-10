<?php

namespace Tests;

use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        File::ensureDirectoryExists(storage_path('framework/cache/data'));

        config([
            'cache.default' => 'array',
            'model-cache.cache_store' => 'array',
        ]);
    }

    public function setSetting(string $key, $value): void
    {
        $result = set_setting($key, $value);
        if (! $result) {
            throw new Exception('Setting not set');
        }
    }

    public function assertAuthenticatedAs($user, $guard = null)
    {
        $expected = $this->app->make('auth')->guard($guard)->user();

        $this->assertNotNull($expected, 'The current user is not authenticated.');

        $this->assertInstanceOf(
            get_class($expected),
            $user,
            'The currently authenticated user is not who was expected',
        );

        $this->assertEquals(
            $expected->getAuthIdentifier(),
            $user->getAuthIdentifier(),
            'The currently authenticated user is not who was expected',
        );

        return $this;
    }
}
