<?php

namespace App\Livewire\Layout;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Notifications extends Component
{
    public int $notifications_count = 0;

    public bool $shown = false;

    protected $notifications = null;

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
        if (Auth::check()) {
            $query = $this->notificationsQuery();
            $notificationsCount = (clone $query)
                ->whereNull('read_at')
                ->count();
            $notificationsAlert = (clone $query)
                ->whereNull('notified_at')
                ->get();

            $this->notifications = (clone $query)
                ->take(15)
                ->get();

            if ($notificationsAlert->count()) {
                foreach ($notificationsAlert as $alert) {
                    $alert->notified_at = now();
                    $alert->updateQuietly();
                    $this->dispatch('new-notification', title: $alert->contents);
                }
            }

            $this->notifications_count = $notificationsCount;
        }
    }

    public function toggleShown(): void
    {
        $this->shown = ! $this->shown;
    }

    public function render(): View
    {
        return view('livewire.layout.notifications');
    }

    protected function notificationsQuery(): MorphMany
    {
        return Auth::user()
            ->system_notifications()
            ->latest('created_at');
    }
}
