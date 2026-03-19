<?php

namespace App\Livewire\Layout;

use App\Livewire\Concerns\InteractsWithSystemNotifications;
use Illuminate\View\View;
use Livewire\Component;

class Notifications extends Component
{
    use InteractsWithSystemNotifications;

    public bool $shown = false;

    public function boot(): void
    {
        $this->dispatchPendingNotifications();
    }

    public function toggleShown(): void
    {
        $this->shown = ! $this->shown;
    }

    public function render(): View
    {
        return view('livewire.layout.notifications');
    }

    protected function dispatchPendingNotifications(): void
    {
        $notifications = $this->notificationsQuery()
            ->whereNull('notified_at')
            ->get();

        foreach ($notifications as $notification) {
            $notification->forceFill([
                'notified_at' => now(),
            ])->saveQuietly();

            $this->dispatch('new-notification', title: $notification->contents);
        }
    }
}
