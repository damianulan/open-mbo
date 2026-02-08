<?php

namespace App\Support\Notifications;

use App\Support\Notifications\Contracts\NotificationResource;
use App\Support\Notifications\Events\MailNotificationSent;
use App\Support\Notifications\Events\SystemNotificationSent;
use App\Support\Notifications\Exceptions\ModelTraitNotUsed;
use App\Support\Notifications\Exceptions\NotificationPlaceholderNotRecognized;
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
    protected array $placeholders = [];

    protected NotificationContents $contents;

    protected array $resources = [];

    protected $email_sent = false;

    protected $system_sent = false;

    private bool $valid = false;

    /**
     * Construct message from parameters
     *
     * @param \App\Support\Notifications\Models\Notification $notification
     * @param \Illuminate\Database\Eloquent\Model            $notifiable
     * @param array                                          $datas - models to match notification resources or additional placeholder data
     */
    public function __construct(
        protected Notification $notification,
        protected Model $notifiable,
        protected array $datas = []
    ) {
        foreach ($datas as $key => $value) {
            if($value instanceof Model){
                $resource = ResourceFactory::matchModel($value);
                $this->addPlaceholders($resource);
            } else {
                if(is_object($value) || is_array($value)){
                    throw new NotificationPlaceholderNotRecognized();
                }

                $this->addDatas($key, $value);
            }
        }

        if (class_uses_trait(Notifiable::class, get_class($this->notifiable))) {
            $resource = ResourceFactory::matchModel($notifiable);
            $this->addPlaceholders($resource);
        } else {
            throw new ModelTraitNotUsed($notifiable, Notifiable::class);
        }
        $this->contents = $this->notification->contents->fill($this->placeholders);

        $this->valid = true;
    }

    public function getDatas(): array
    {
        return $this->datas;
    }

    public function send(): bool
    {
        $result = $this->valid;
        if ($result) {
            try {
                $mail = $this->notification->email ? $this->toMail() : null;
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
                    $mailSent = Mail::to($this->notifiable)->send($mail);
                    if ( ! $mailSent) {
                        $result = false;
                    } else {
                        $toMail = MailNotification::create([
                            'notification_id' => $this->notification->id,
                            'notifiable_id' => $this->notifiable->id,
                            'notifiable_type' => get_class($this->notifiable),
                            'resources' => json_encode($this->resources),
                            'subject' => $this->contents->subject,
                            'contents' => $this->contents->email_contents,
                        ]);
                        if($toMail) {
                            $this->email_sent = true;
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
        return new MailMessage($this->contents);
    }

    protected function toSystem(): array
    {
        return [
            'notification_id' => $this->notification->id,
            'notifiable_id' => $this->notifiable->id,
            'notifiable_type' => get_class($this->notifiable),
            'resources' => json_encode($this->resources),
            'contents' => $this->contents->system_contents,
        ];
    }

    private function addPlaceholders($resource): void
    {
        if ( ! is_null($resource) && is_object($resource)) {
            if ($resource instanceof NotificationResource) {
                $class = get_class($resource->getModel());
                $this->resources[$class] = $resource->getKey();
                foreach ($resource->datas() as $key => $value) {
                    $this->placeholders[$key] = $value;
                }
            }
        }
        // else {
        //     if(!is_null($resource)){
        //         $resource = is_object($resource) ? get_class($resource) : $resource;
        //         throw new Exception('Given notification resource ' . $resource . ' is not of type ' . NotificationResource::class);
        //     } else {
        //         throw new Exception('Given notification resource cannot be null');
        //     }
        // }
    }

    private function addDatas(string $key, $value): void
    {
        $this->placeholders[$key] = $value;
    }
}
