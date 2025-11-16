<?php

namespace App\Support\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class MailMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email_contents;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected NotificationContents $contents,
    ) {
        if (empty($contents->email_contents) || empty($contents->subject)) {
            return null;
        }

        $this->subject($contents->subject);
        $this->email_contents = $contents->email_contents;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.orders.shipped',
            with: array(
                'contents' => $this->email_contents,
            )
        );
    }
}
