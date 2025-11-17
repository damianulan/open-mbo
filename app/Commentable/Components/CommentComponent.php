<?php

namespace App\Commentable\Components;

use App\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentComponent extends Component
{
    public Model $subject;

    public function mount(Model $subject): void
    {
        $this->subject = $subject;
        Comment::all();
    }

    #[On('commentable.submit')]
    public function submit(?string $content, bool $private = false): void
    {
        $user = Auth::user();

        if ( ! empty($content)) {
            $this->subject->comments()->create([
                'author_id' => $user->id,
                'author_type' => $user->getMorphClass(),
                'content' => $content,
                'private' => $private,
            ]);

            $this->dispatch('commentable.initialize.quill');
        }
    }

    public function delete($id): void
    {
        Comment::mine()->find($id)->delete();
    }

    public function flashSuccess(string $message): void
    {
        $this->js('$.success("' . $message . '")');
    }

    public function flashError(string $message): void
    {
        $this->js('$.error("' . $message . '")');
    }

    public function render()
    {
        return view('livewire.commentable.comments');
    }
}
