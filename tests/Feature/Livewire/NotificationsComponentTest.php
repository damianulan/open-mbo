<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Layout\Notifications;
use App\Livewire\Notifications\Index;
use App\Models\Core\User;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Models\SystemNotification;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationsComponentTest extends TestCase
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
    }

    public function test_dropdown_marks_pending_notifications_as_notified(): void
    {
        $user = User::factory()->create();
        $notification = $this->createSystemNotification($user, '<strong>Fresh notification</strong>');

        Livewire::actingAs($user)
            ->test(Notifications::class)
            ->assertDispatched('new-notification');

        $this->assertNotNull($notification->fresh()->notified_at);
    }

    public function test_notifications_page_can_select_notification_from_query_string(): void
    {
        $user = User::factory()->create();
        $notification = $this->createSystemNotification($user, '<strong>Read me</strong><br>right now');

        Livewire::withQueryParams([
            'notification' => $notification->id,
        ])
            ->actingAs($user)
            ->test(Index::class)
            ->assertSet('selectedNotificationId', $notification->id)
            ->assertViewHas('selectedNotification', fn (?SystemNotification $selectedNotification): bool => $selectedNotification?->is($notification) ?? false);

        $this->assertNotNull($notification->fresh()->read_at);
    }

    public function test_user_cannot_select_another_users_notification(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $foreignNotification = $this->createSystemNotification($anotherUser, '<strong>Private</strong>');

        Livewire::actingAs($user)
            ->test(Index::class)
            ->call('showNotification', $foreignNotification->id)
            ->assertSet('selectedNotificationId', null);

        $this->assertNull($foreignNotification->fresh()->read_at);
    }

    protected function createSystemNotification(User $user, string $contents): SystemNotification
    {
        $notificationDefinition = Notification::byKey('CAMPAIGN_ASSIGNED');

        return SystemNotification::query()->create([
            'notification_id' => $notificationDefinition->id,
            'notifiable_type' => $user->getMorphClass(),
            'notifiable_id' => $user->id,
            'resources' => json_encode([]),
            'contents' => $contents,
        ]);
    }
}
