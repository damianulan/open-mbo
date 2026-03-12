<?php

namespace Tests\Feature\Profile;

use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        config(['cache.default' => 'array']);
        config(['model-cache.cache_store' => 'array']);
        Queue::fake();

        $this->setSetting('users.password_change_firstlogin', false);
        $this->setSetting('users.force_password_change_reset', false);
    }

    public function test_authenticated_user_can_update_profile_data(): void
    {
        $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create();

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'firstname' => 'Updated',
            'lastname' => 'Profile',
            'email' => 'updated.profile@example.test',
            'birthday' => '1995-07-20',
        ]);

        $response->assertRedirect(route('profile.index'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Updated',
            'lastname' => 'Profile',
            'email' => 'updated.profile@example.test',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'birthday' => '1995-07-20',
        ]);
    }

    public function test_authenticated_user_can_update_avatar(): void
    {
        Storage::fake('uploads');

        $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create();
        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'birthday' => '1995-07-20',
            'avatar' => $avatar,
        ]);

        $response->assertRedirect(route('profile.index'));

        $expectedPath = 'avatars/avatar_' . $user->id . '.jpg';

        Storage::disk('uploads')->assertExists($expectedPath);
        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'avatar' => 'uploads/' . $expectedPath,
        ]);
    }

    public function test_profile_update_requires_unique_email(): void
    {
        $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create();
        $existing = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('profile.index'))
            ->post(route('profile.update'), [
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $existing->email,
                'birthday' => '1995-07-20',
            ]);

        $response->assertRedirect(route('profile.index'));
        $response->assertSessionHasErrors(['email']);
    }

    public function test_get_avatar_returns_public_upload_url(): void
    {
        $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create();
        $user->profile->avatar = 'uploads/avatars/avatar_' . $user->id . '.jpg';
        $user->profile->save();

        $avatarUrl = $user->fresh()->getAvatar();

        $this->assertNotNull($avatarUrl);
        $this->assertStringContainsString('/uploads/avatars/avatar_' . $user->id . '.jpg', $avatarUrl);
    }
}
