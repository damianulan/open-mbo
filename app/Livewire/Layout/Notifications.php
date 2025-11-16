<?php

namespace App\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public int $notifications_count = 0;

    public bool $shown = false;

    protected $notifications;

    public function mount(): void
    {
        $this->register();
    }

    public function boot(): void
    {
        $this->register();
    }

    public function register(): void
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

    public function toggleShown(): void
    {
        $this->shown = ! $this->shown;
    }

    public function render()
    {
        return view('livewire.layout.notifications');
    }
}
