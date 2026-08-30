<?php

namespace Tests\Feature\User;

use App\Enums\Users\UserStatus;
use App\Factories\Users\UserStatusFactory;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserStatusFactoryTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Model::preventLazyLoading(false);

        parent::tearDown();
    }

    public function test_it_keeps_the_expected_status_priority(): void
    {
        $user = User::factory()->make([
            'email_verified_at' => null,
            'suspended_at' => now(),
            'deleted_at' => now(),
        ]);

        $this->assertSame(UserStatus::DELETED, UserStatusFactory::make($user));

        $user->deleted_at = null;

        $this->assertSame(UserStatus::SUSPENDED, UserStatusFactory::make($user));

        $user->suspended_at = null;

        $this->assertSame(UserStatus::UNVERIFIED, UserStatusFactory::make($user));
    }

    public function test_it_uses_the_preloaded_employment_exists_attribute_without_lazy_loading(): void
    {
        $user = User::factory()->create();

        Model::preventLazyLoading();

        $loadedUser = UserStatusFactory::withEmploymentExists(User::query())
            ->findOrFail($user->id);

        $this->assertSame(UserStatus::UNEMPLOYED, UserStatusFactory::make($loadedUser));
        $this->assertFalse($loadedUser->relationLoaded('employment'));
    }

    public function test_it_returns_active_when_the_preloaded_employment_exists_attribute_is_true(): void
    {
        $user = User::factory()->create();

        UserEmployment::query()->create([
            'user_id' => $user->id,
            'employment' => now()->subDay(),
        ]);

        Model::preventLazyLoading();

        $loadedUser = UserStatusFactory::withEmploymentExists(User::query())
            ->findOrFail($user->id);

        $this->assertSame(UserStatus::ACTIVE, UserStatusFactory::make($loadedUser));
        $this->assertFalse($loadedUser->relationLoaded('employment'));
    }
}
