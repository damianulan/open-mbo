<?php

namespace App\Livewire\Notifications;

use App\Livewire\Concerns\InteractsWithSystemNotifications;
use App\Support\Notifications\Models\SystemNotification;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{
    use InteractsWithSystemNotifications;

    #[Locked]
    public ?string $selectedNotificationId = null;

    public function mount(): void
    {
        $notificationId = request()->query('notification');

        if ( ! is_string($notificationId) || '' === $notificationId) {
            return;
        }

        $this->showNotification($notificationId);
    }

    public function showNotification(string $notificationId): void
    {
        $notification = $this->findNotification($notificationId);

        if ( ! $notification instanceof SystemNotification) {
            return;
        }

        $notification->markAsRead();
        $this->selectedNotificationId = $notification->id;
    }

    public function render(): View
    {
        return view('livewire.notifications.index', [
            'notifications' => $this->allNotifications,
            'selectedNotification' => $this->selectedNotification,
        ])->extends('layouts.portal.master')->section('content');
    }

    #[Computed]
    public function selectedNotification(): ?SystemNotification
    {
        if ( ! $this->selectedNotificationId) {
            return null;
        }

        return $this->findNotification($this->selectedNotificationId);
    }
}
