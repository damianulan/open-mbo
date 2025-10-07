<?php

namespace App\Support\Notifications;

use Illuminate\Mail\Mailable;
use App\Support\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use App\Support\Notifications\Contracts\NotificationResource;

class NotificationMessage
{
    protected array $placeholders = [];
    protected NotificationContents $contents;

    public function __construct(
        protected Notification $notification,
        protected Model $notifiable,
        protected array $resourceModels = []
    ) {
        foreach ($resourceModels as $model) {
            if ($model instanceof Model) {
                $resource = $model->notificationResource() ?? null;
                $this->addPlaceholders($resource);
            }
        }

        $resource = $notifiable->notificationResource() ?? null;
        $this->addPlaceholders($resource);
        $this->contents = $this->notification->contents->fill($this->placeholders);
    }

    private function addPlaceholders($resource): void
    {
        if ($resource && $resource instanceof NotificationResource) {
            foreach ($resource->datas() as $key => $value) {
                $this->placeholders[$key] = $value;
            }
        }
    }

    public function toMail(): ?Mailable
    {
        return null;
    }

    public function toSystem(): array
    {
        return [];
    }

    public function send(): void
    {
        $mail = $this->notification->mail ? $this->toMail() : null;
        $system = $this->notification->system ? $this->toSystem() : null;

        if ($mail) {
        }

        if ($system) {
        }
    }
}
