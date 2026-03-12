<?php

namespace Tests\Feature\Profile;

use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProfilePreferencesTest extends TestCase
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

    public function test_authenticated_user_can_update_profile_preferences(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('profile.preferences.update'), [
            'lang' => 'en',
            'theme' => 'auto',
            'mail_notifications' => '1',
            'app_notifications' => '0',
            'extended_notifications' => '1',
            'system_notifications' => '0',
        ]);

        $response->assertRedirect(route('profile.preferences'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('user_preferences', [
            'user_id' => $user->id,
            'lang' => 'en',
            'theme' => 'auto',
        ]);

        $user->refresh();
        $preferences = $user->preferences()->withTrashed()->latest('id')->first();

        $this->assertNotNull($preferences);
        $this->assertTrue($preferences->mail_notifications);
        $this->assertFalse($preferences->app_notifications);
        $this->assertTrue($preferences->extended_notifications);
        $this->assertFalse($preferences->system_notifications);
        $this->assertSame(1, DB::table('user_preferences')->where('user_id', $user->id)->whereNull('deleted_at')->count());
    }

    public function test_profile_preferences_requires_valid_values(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('profile.preferences'))
            ->post(route('profile.preferences.update'), [
                'lang' => 'xx',
                'theme' => 'non-existing-theme',
                'mail_notifications' => '1',
                'app_notifications' => '0',
                'extended_notifications' => '1',
                'system_notifications' => '0',
            ]);

        $response->assertRedirect(route('profile.preferences'));
        $response->assertSessionHasErrors(['lang', 'theme']);
    }
}
