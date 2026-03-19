<?php

namespace Tests\Feature\Debugbar;

use Illuminate\Auth\Middleware\Authenticate;
use Tests\TestCase;

class DebugbarConfigTest extends TestCase
{
    public function test_debugbar_routes_run_through_web_middleware_before_authentication(): void
    {
        $middleware = config('debugbar.route_middleware');

        $this->assertIsArray($middleware);
        $this->assertContains('web', $middleware);
        $this->assertContains(Authenticate::class, $middleware);
        $this->assertLessThan(
            array_search(Authenticate::class, $middleware, true),
            array_search('web', $middleware, true)
        );
    }
}
