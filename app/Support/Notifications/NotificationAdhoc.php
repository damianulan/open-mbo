<?php

namespace App\Support\Notifications;

use Illuminate\Contracts\Support\Arrayable;

class NotificationAdhoc implements Arrayable
{
    protected $icon;

    protected $message;

    public static function make(string $message, ?string $icon = null): self
    {
        $instance = new self;
        if (is_null($icon)) {
            $icon = 'bi-bell-fill';
        }
        $instance->message = $message;
        $instance->icon = $icon;

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'icon' => $this->icon,
            'message' => $this->message,
        ];
    }
}
