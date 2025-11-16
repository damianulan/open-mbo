<?php

namespace App\Support\Notifications\Factories;

use App\Models\Core\User;
use App\Models\MBO\UserCampaign;
use App\Notifications\Resources\UserCampaignResource;
use App\Notifications\Resources\UserResource;
use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Contracts\NotificationResource;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class ResourceFactory
{
    public static function matchModel(Model $model): ?NotificationResource
    {
        return match ($model::class) {
            UserCampaign::class => new UserCampaignResource($model),
            User::class => new UserResource($model),
            default => null
        };
    }

    public static function getEventResourceModels($event): array
    {
        $reflection = new ReflectionClass($event);

        $models = array();

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
