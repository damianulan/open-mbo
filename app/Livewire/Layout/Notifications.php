<?php

namespace App\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Support\Notifications\Models\Notification;

class Notifications extends Component
{
    protected $notifications;

    public int $notifications_count = 0;

    public bool $shown = false;

    public function mount()
    {
        $this->register();
    }

    public function boot()
    {
        $this->register();
    }

    public function register()
    {
        $query = Auth::user()->system_notifications();
        $notifications_count = $query->count();
        $queryAlert = clone $query;
        $notificationsAlert = $queryAlert->whereNull('notified_at')->get();

        $this->notifications = $query->take(15)->get();

        if ($notificationsAlert->count()) {
            foreach ($notificationsAlert as $alert) {
                $alert->notified_at = now();
                $alert->updateQuietly();
                $this->dispatch('new-notification', title: $alert->contents);
            }
        }

        $this->notifications_count = $notifications_count;
    }

    public function toggleShown()
    {
        $this->shown = ! $this->shown;
    }

    public function render()
    {
        return view('livewire.layout.notifications');
    }
}
