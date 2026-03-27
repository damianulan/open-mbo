<?php

namespace App\Commentable\Components;

use App\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentComponent extends Component
{
    public Model $subject;

    public function mount(Model $subject): void
    {
        $this->subject = $subject;
    }

    #[Computed]
    public function comments(): Collection
    {
        return $this->subject
            ->comments()
            ->with('author')
            ->orderBy('id')
            ->get();
    }

    #[On('commentable.submit')]
    public function submit(?string $content, bool $private = false): void
    {
        if (blank(strip_tags($content ?? ''))) {
            return;
        }

        $user = Auth::user();

        if ( ! $user) {
            return;
        }

        $this->subject->comments()->create([
            'author_id' => $user->id,
            'author_type' => $user->getMorphClass(),
            'content' => $content,
            'private' => $private,
        ]);

        $this->dispatch('commentable.initialize.quill');
    }

    public function delete(int $id): void
    {
        $comment = Comment::mine()->find($id);

        if ( ! $comment instanceof Comment) {
            return;
        }

        $comment->delete();
    }

    public function flashSuccess(string $message): void
    {
        $this->js('$.success("' . $message . '")');
    }

    public function flashError(string $message): void
    {
        $this->js('$.error("' . $message . '")');
    }

    public function render(): View
    {
        return view('livewire.commentable.comments');
    }
}
