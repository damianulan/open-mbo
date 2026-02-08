<?php

namespace Tests\Feature\Auth;

use App\Models\Core\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Tests\DatabaseTestCase;

class LoginTest extends DatabaseTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_redirection_if_not_logged_in(): void
    {
        $response = $this->get(RouteServiceProvider::HOME);

        $response->assertStatus(302);
    }

    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = '123456'),
        ]);

        $response = $this->from(RouteServiceProvider::LOGIN)->post(RouteServiceProvider::LOGIN, [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_view_a_login_form_when_authenticated(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get(RouteServiceProvider::LOGIN);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_remember_me_functionality(): void
    {
        $user = User::factory()->create([
            'id' => random_int(1, 100),
            'password' => Hash::make($password = '123456'),
        ]);

        $response = $this->post(RouteServiceProvider::LOGIN, [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
    }
}
