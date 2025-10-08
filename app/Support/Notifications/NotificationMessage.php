<?php

namespace App\Support\Notifications;

use App\Support\Notifications\Contracts\NotificationResource;
use App\Support\Notifications\Events\MailNotificationSent;
use App\Support\Notifications\Events\SystemNotificationSent;
use App\Support\Notifications\Exceptions\ModelTraitNotUsed;
use App\Support\Notifications\Models\MailNotification;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Models\SystemNotification;
use App\Support\Notifications\Traits\Notifiable;
use App\Support\Notifications\Traits\NotifiableResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class NotificationMessage
{
    protected array $placeholders = [];

    protected NotificationContents $contents;

    protected array $resources = [];

    private bool $valid = false;

    protected $email_sent = false;

    protected $system_sent = false;

    public function __construct(
        protected Notification $notification,
        protected Model $notifiable,
        protected array $resourceModels = []
    ) {
        try {
            foreach ($resourceModels as $model) {
                if (class_uses_trait(NotifiableResource::class, $model::class)) {
                    $resource = $model->getNotificationResource() ?? null;
                    $this->addPlaceholders($resource);
                } else {
                    throw new ModelTraitNotUsed($model, NotifiableResource::class);
                }
            }

            if (class_uses_trait(Notifiable::class, $notifiable::class)) {
                $resource = $notifiable->getNotificationResource() ?? null;
                $this->addPlaceholders($resource);
            } else {
                throw new ModelTraitNotUsed($notifiable, Notifiable::class);
            }
            $this->contents = $this->notification->contents->fill($this->placeholders);

            $this->valid = true;
        } catch (\Exception $th) {
            report($th);
            if (config('app.debug')) {
                throw $th;
            }
        }
    }

    private function addPlaceholders($resource): void
    {
        if ($resource && $resource instanceof NotificationResource) {
            $class = $resource::class;
            $this->resources[$class] = $resource->getKey();
            foreach ($resource->datas() as $key => $value) {
                $this->placeholders[$key] = $value;
            }
        } else {
            throw new \Exception('Given notification resource is not of type '.NotificationResource::class);
        }
    }

    protected function toMail(): ?Mailable
    {
        return new MailMessage($this->content);
    }

    protected function toSystem(): array
    {
        return [
            'notification_id' => $this->notification->id,
            'notifiable_id' => $this->notifiable->id,
            'notifiable_type' => $this->notifiable::class,
            'resources' => json_encode($this->resources),
            'contents' => $this->contents->system_contents,
        ];
    }

    public function send(): bool
    {
        $result = $this->valid;
        if ($result) {
            try {
                $mail = $this->notification->mail ? $this->toMail() : null;
                $system = $this->notification->system ? $this->toSystem() : null;

                if ($system && config('notifications.system_notifications')) {
                    $toSystem = SystemNotification::create($this->toSystem());
                    if ($toSystem) {
                        $this->system_sent = true;
                        SystemNotificationSent::dispatch($toSystem);
                    } else {
                        $result = false;
                    }
                }

                if ($mail && config('notifications.email_notifications')) {
                    $mailable = $this->toMail();
                    if ($mailable) {
                        $mailSent = Mail::to($this->notifiable)->send($mailable);
                        if (! $mailSent) {
                            $result = false;
                        } else {
                            $this->email_sent = true;
                            $toMail = MailNotification::create([
                                'notification_id' => $this->notification->id,
                                'notifiable_id' => $this->notifiable->id,
                                'notifiable_type' => $this->notifiable::class,
                                'resources' => json_encode($this->resources),
                                'subject' => $this->contents->subject,
                                'contents' => $this->contents->email_contents,
                            ]);
                            MailNotificationSent::dispatch($toMail);
                        }
                    }
                }
            } catch (\Exception $th) {
                report($th);
                if (config('app.debug')) {
                    throw $th;
                } else {
                    $result = false;
                }
            }
        }

        return $result;
    }
}
