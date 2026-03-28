<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class NoteCard extends Component
{
    public function __construct(public Model $subject, public ?string $title = null, public bool $minimized = false)
    {
        if (is_null($this->title)) {
            $this->title = __('globals.notes');
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.note-card');
    }
}
