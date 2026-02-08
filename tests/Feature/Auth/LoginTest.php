<?php

namespace Tests\Feature\Auth;

use Tests\DatabaseTestCase;

class LoginTest extends DatabaseTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
