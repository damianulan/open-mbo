<?php

namespace App\Support\Notifications;

use App\Support\Notifications\Contracts\NotificationResource;
use App\Support\Notifications\Events\MailNotificationSent;
use App\Support\Notifications\Events\SystemNotificationSent;
use App\Support\Notifications\Exceptions\ModelTraitNotUsed;
use App\Support\Notifications\Factories\ResourceFactory;
use App\Support\Notifications\Models\MailNotification;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Models\SystemNotification;
use App\Support\Notifications\Traits\Notifiable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class NotificationMessage
{
    protected array $placeholders = array();

    protected NotificationContents $contents;

    protected array $resources = array();

    protected $email_sent = false;

    protected $system_sent = false;

    private bool $valid = false;

    public function __construct(
        protected Notification $notification,
        protected Model $notifiable,
        protected array $resourceModels = array()
    ) {
        try {
            foreach ($resourceModels as $model) {
                $resource = ResourceFactory::matchModel($model);
                $this->addPlaceholders($resource);
            }

            if (class_uses_trait(Notifiable::class, $notifiable::class)) {
                $resource = ResourceFactory::matchModel($notifiable);
                $this->addPlaceholders($resource);
            } else {
                throw new ModelTraitNotUsed($notifiable, Notifiable::class);
            }
            $this->contents = $this->notification->contents->fill($this->placeholders);

            $this->valid = true;
        } catch (Exception $th) {
            report($th);
            if (config('app.debug')) {
                throw $th;
            }
        }
    }

    public function getModels(): array
    {
        return $this->resourceModels;
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
                        if ( ! $mailSent) {
                            $result = false;
                        } else {
                            $this->email_sent = true;
                            $toMail = MailNotification::create(array(
                                'notification_id' => $this->notification->id,
                                'notifiable_id' => $this->notifiable->id,
                                'notifiable_type' => $this->notifiable::class,
                                'resources' => json_encode($this->resources),
                                'subject' => $this->contents->subject,
                                'contents' => $this->contents->email_contents,
                            ));
                            MailNotificationSent::dispatch($toMail);
                        }
                    }
                }
            } catch (Exception $th) {
                report($th);
                if (config('app.debug')) {
                    throw $th;
                }
                $result = false;

            }
        }

        return $result;
    }

    protected function toMail(): ?Mailable
    {
        return new MailMessage($this->content);
    }

    protected function toSystem(): array
    {
        return array(
            'notification_id' => $this->notification->id,
            'notifiable_id' => $this->notifiable->id,
            'notifiable_type' => $this->notifiable::class,
            'resources' => json_encode($this->resources),
            'contents' => $this->contents->system_contents,
        );
    }

    private function addPlaceholders($resource): void
    {
        if ($resource && $resource instanceof NotificationResource) {
            $class = $resource->getModel()::class;
            $this->resources[$class] = $resource->getKey();
            foreach ($resource->datas() as $key => $value) {
                $this->placeholders[$key] = $value;
            }
        } else {
            throw new Exception('Given notification resource ' . $resource::class . ' is not of type ' . NotificationResource::class);
        }
    }
}
