<?php

namespace App\Livewire\Concerns;

use App\Support\Notifications\Models\SystemNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

trait InteractsWithSystemNotifications
{
    #[Computed]
    public function allNotifications(): Collection
    {
        return $this->notificationsQuery()->get();
    }

    #[Computed]
    public function notifications(): Collection
    {
        return $this->notificationsQuery()
            ->limit(15)
            ->get();
    }

    #[Computed]
    public function unreadNotificationsCount(): int
    {
        return (clone $this->notificationsQuery())
            ->whereNull('read_at')
            ->count();
    }

    protected function findNotification(string $notificationId): ?SystemNotification
    {
        $notification = $this->notificationsQuery()->find($notificationId);

        if ( ! $notification instanceof SystemNotification) {
            return null;
        }

        return $notification;
    }

    protected function notificationsQuery(): MorphMany
    {
        return Auth::user()
            ->system_notifications()
            ->latest('created_at');
    }
}
