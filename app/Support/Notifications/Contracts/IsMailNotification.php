<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Notifications\Messages\MailMessage;

interface IsMailNotification
{
    /**
     * Contains message to be sent via mail.
     */
    public function toMail(object $notifiable): MailMessage;
}
