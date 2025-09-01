<?php

namespace App\Commentable\Components;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Commentable\Models\Comment;

class CommentComponent extends Component
{
    public Model $subject;

    protected Collection $comments;

    public function mount(Model $subject)
    {
        $this->subject = $subject;
        $this->comments = $subject->comments()->direct()->get();
    }

    public function boot()
    {
        $this->dispatch('commentable.initialize.quill');
    }

    #[On('commentable.submit')]
    public function submit(?string $content)
    {
        $user = Auth::user();

        $comment = new Comment;
        $comment->author_id = $user->id;
        $comment->author_type = $user->getMorphClass();
        $comment->content = $content;

        $this->subject->comments()->create([
            'author_id' => $user->id,
            'author_type' => $user->getMorphClass(),
            'content' => $content,
        ]);

        $this->flashSuccess($content);
    }

    public function delete() {}

    public function flashSuccess(string $message)
    {
        $this->js('$.success("' . $message . '")');
    }

    public function flashError(string $message)
    {
        $this->js('$.error("' . $message . '")');
    }

    public function render()
    {
        return view('livewire.commentable.comments');
    }
}
