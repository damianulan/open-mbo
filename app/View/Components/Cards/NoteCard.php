<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class NoteCard extends Component
{
    /**
     * Create a new component instance.
     * @param Model $subject
     * @param ?string $title
     * @param bool $minimized
     */
    public function __construct(public Model $subject, public ?string $title = null, public bool $minimized = false)
    {
        if (is_null($this->title)) {
            $this->title = __('Notatki');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.note-card');
    }
}
