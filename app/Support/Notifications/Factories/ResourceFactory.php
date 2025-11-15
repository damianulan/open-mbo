<?php

namespace App\Support\Notifications\Factories;

use App\Notifications\Resources\UserResource;
use App\Notifications\Resources\UserCampaignResource;
use App\Support\Notifications\Contracts\NotificationResource;
use Illuminate\Database\Eloquent\Model;
use App\Support\Notifications\Contracts\NotifiableEvent;

class ResourceFactory
{

    public static function matchModel(Model $model): ?NotificationResource
    {
        return match ($model::class) {
            \App\Models\MBO\UserCampaign::class => new UserCampaignResource($model),
            \App\Models\Core\User::class => new UserResource($model),
            default => null
        };
    }

    public static function getEventResourceModels($event): array
    {
        $reflection = new \ReflectionClass($event);

        $models = [];

        if ($reflection->implementsInterface(NotifiableEvent::class)) {
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                $value = null;
                if (is_object($event)) {
                    $value = $property->getValue($event);
                } else {
                    if (class_exists($property->getType())) {
                        $class = $property->getType()->__toString();
                        $value = new $class();
                    }
                }

                if ($value && $value instanceof Model) {
                    $models[$value::class] = $value;
                }
            }
        }

        return $models;
    }
}
