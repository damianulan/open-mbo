<?php

namespace App\Livewire\Layout\Notifications;

use App\Support\Notifications\Models\SystemNotification;
use Illuminate\View\View;
use Livewire\Component;

class Item extends Component
{
    public SystemNotification $notification;

    public ?string $message = null;

    public function mount(SystemNotification $notification): void
    {
        $this->notification = $notification;
        $this->message = $notification->renderedContents();
    }

    public function render(): View
    {
        return view('livewire.layout.notifications.item');
    }
}
