<?php

namespace Tests\Feature\Auth;

use Tests\DatabaseTestCase;

class LoginTest extends DatabaseTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_redirection_if_not_logged_in(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
}
