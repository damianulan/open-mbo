<?php

namespace App\Livewire\Layout;

use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    protected DatabaseNotificationCollection $notifications;

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
        $query = Auth::user()->notifications()->where('data', '!=', '[]');
        $notifications_count = $query->count();
        $queryAlert = $query->whereNull('alerted_at');
        $notificationsAlert = $queryAlert->get();

        $this->notifications = $query->take(15)->get();

        if ($notificationsAlert->count()) {
            foreach ($notificationsAlert as $alert) {
                $alert->alerted_at = now();
                $alert->updateQuietly();
                $this->dispatch('new-notification', title: $alert->data['message']);
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
