<?php

namespace Tests\Feature\Livewire;

use App\Commentable\Components\CommentComponent;
use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class CommentComponentTest extends TestCase
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

    public function test_user_can_submit_a_comment(): void
    {
        $user = User::factory()->create();
        $subject = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CommentComponent::class, ['subject' => $subject])
            ->call('submit', '<p>Hello world</p>', true)
            ->assertDispatched('commentable.initialize.quill');

        $this->assertDatabaseHas('commentables', [
            'subject_type' => $subject->getMorphClass(),
            'subject_id' => $subject->id,
            'author_type' => $user->getMorphClass(),
            'author_id' => $user->id,
            'private' => true,
        ]);
    }

    public function test_blank_comments_are_ignored(): void
    {
        $user = User::factory()->create();
        $subject = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CommentComponent::class, ['subject' => $subject])
            ->call('submit', '<p>   </p>');

        $this->assertDatabaseCount('commentables', 0);
    }

    public function test_user_can_delete_only_their_own_comments(): void
    {
        $user = User::factory()->create();
        $subject = User::factory()->create();
        $anotherUser = User::factory()->create();

        $ownComment = $subject->comments()->create([
            'author_id' => $user->id,
            'author_type' => $user->getMorphClass(),
            'content' => '<p>Mine</p>',
            'private' => false,
        ]);

        $foreignComment = $subject->comments()->create([
            'author_id' => $anotherUser->id,
            'author_type' => $anotherUser->getMorphClass(),
            'content' => '<p>Theirs</p>',
            'private' => false,
        ]);

        Livewire::actingAs($user)
            ->test(CommentComponent::class, ['subject' => $subject])
            ->call('delete', $foreignComment->id);

        $this->assertDatabaseHas('commentables', [
            'id' => $foreignComment->id,
        ]);

        Livewire::actingAs($user)
            ->test(CommentComponent::class, ['subject' => $subject])
            ->call('delete', $ownComment->id);

        $this->assertDatabaseMissing('commentables', [
            'id' => $ownComment->id,
        ]);
    }
}
