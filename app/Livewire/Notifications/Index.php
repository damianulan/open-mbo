<?php

namespace App\Livewire\Notifications;

use App\Support\Notifications\Models\SystemNotification;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
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
        $notification = $this->notificationsQuery()->find($notificationId);

        if ( ! $notification instanceof SystemNotification) {
            return;
        }

        $notification->markAsRead();
        $this->selectedNotificationId = $notification->id;
    }

    public function render(): View
    {
        return view('livewire.notifications.index', [
            'notifications' => $this->notificationsQuery()->get(),
            'selectedNotification' => $this->selectedNotification(),
        ])->extends('layouts.portal.master')->section('content');
    }

    protected function notificationsQuery(): MorphMany
    {
        return Auth::user()
            ->system_notifications()
            ->latest('created_at');
    }

    protected function selectedNotification(): ?SystemNotification
    {
        if ( ! $this->selectedNotificationId) {
            return null;
        }

        return $this->notificationsQuery()->find($this->selectedNotificationId);
    }
}
