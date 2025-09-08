<?php

namespace App\Notifications\System;

use App\Support\Notifications\BaseNotification;
use App\Support\Notifications\Contracts\IsMailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class AppRefreshNotification extends BaseNotification implements IsMailNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('OpenMBO App refreshed')
            ->line('The OpenMBO application has been refreshed.')
            ->action('Log in here', url('/'))
            ->line('Thanks!');
    }
}
