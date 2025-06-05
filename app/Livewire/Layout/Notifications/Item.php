<?php

namespace App\Livewire\Layout\Notifications;

use Livewire\Component;

class Item extends Component
{
    public $notification;
    public $message;

    public function mount($notification)
    {
        $this->notification = $notification;
        $message = $this->notification->data['message'] ?? null;
        if ($message) {
            $message = strip_tags($message, '<strong><i>');
        }
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.layout.notifications.item');
    }
}
