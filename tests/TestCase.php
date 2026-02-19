<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setSetting(string $key, $value): void
    {
        $result = set_setting($key, $value);
        if(!$result) {
            throw new \Exception('Setting not set');
        }
    }

    public function assertAuthenticatedAs($user, $guard = null)
    {
        $expected = $this->app->make('auth')->guard($guard)->user();

        $this->assertNotNull($expected, 'The current user is not authenticated.');

        $this->assertInstanceOf(
            get_class($expected), $user,
            'The currently authenticated user is not who was expected'
        );

        $this->assertEquals(
            $expected->getAuthIdentifier(), $user->getAuthIdentifier(),
            'The currently authenticated user is not who was expected'
        );

        return $this;
    }
}
