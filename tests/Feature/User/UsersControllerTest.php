<?php

namespace Tests\Feature\User;

use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasUserCollection;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        config(['cache.default' => 'array']);
        config(['model-cache.enabled' => false]);
        config(['model-cache.cache_store' => 'array']);
        $this->setSetting('users.password_change_firstlogin', false);
        $this->setSetting('users.force_password_change_reset', false);
        $this->fillUsers();
    }

    public function test_admin_can_toggle_user_block_status(): void
    {
        $admin = $this->getAdmin();
        $targetUser = $this->userFactory();

        $this->from('/users')
            ->actingAs($admin)
            ->get(route('users.block', $targetUser))
            ->assertRedirect('/users');

        $this->assertTrue($targetUser->fresh()->blocked());

        $this->from('/users')
            ->actingAs($admin)
            ->get(route('users.block', $targetUser))
            ->assertRedirect('/users');

        $this->assertFalse($targetUser->fresh()->blocked());
    }

    public function test_user_without_delete_permission_cannot_toggle_user_block_status(): void
    {
        $adminHr = $this->getAdminHr();
        $targetUser = $this->userFactory();

        $this->actingAs($adminHr)
            ->get(route('users.block', $targetUser))
            ->assertForbidden();
    }

    public function test_user_can_add_and_remove_favourite_user(): void
    {
        $user = $this->getEmployee();
        $favouriteUser = $this->userFactory();

        $this->from('/dashboard')
            ->actingAs($user->fresh())
            ->get(route('users.favourite', $favouriteUser))
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('favourities', [
            'user_id' => $user->id,
            'subject_type' => User::class,
            'subject_id' => $favouriteUser->id,
        ]);

        $this->from('/dashboard')
            ->actingAs($user)
            ->get(route('users.favourite', $favouriteUser))
            ->assertRedirect('/dashboard');

        $this->assertDatabaseMissing('favourities', [
            'user_id' => $user->id,
            'subject_type' => User::class,
            'subject_id' => $favouriteUser->id,
        ]);
    }

    public function test_admin_can_reset_user_password_and_force_password_change(): void
    {
        $admin = $this->getAdmin();
        $targetUser = $this->userFactory([
            'force_password_change' => 0,
        ]);

        $this->from('/users')
            ->actingAs($admin)
            ->get(route('users.reset_password', $targetUser))
            ->assertRedirect('/users')
            ->assertSessionHas('success_alert');

        $this->assertSame(1, $targetUser->fresh()->force_password_change);
    }

    public function test_employee_cannot_reset_other_user_password(): void
    {
        $employee = $this->getEmployee();
        $targetUser = $this->userFactory();

        $this->actingAs($employee)
            ->get(route('users.reset_password', $targetUser))
            ->assertForbidden();
    }
}
