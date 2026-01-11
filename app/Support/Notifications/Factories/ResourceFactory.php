<?php

namespace App\Support\Notifications\Factories;

use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Contracts\NotificationResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use ReflectionClass;
use ReflectionProperty;

class ResourceFactory
{
    public static function matchModel(Model $model): ?NotificationResource
    {
        $reflection = new ReflectionClass($model);
        $shortname = $reflection->getShortName() . 'Resource';
        $class = match (get_class($model)) {
            default => "\\App\\Notifications\\Resources\\{$shortname}",
        };
        Log::debug("NotificationResource::matchModel class {$class}");
        if (class_exists($class)) {
            return new $class($model);
        }

        return null;
    }

    public static function getEventResourceModels($event): array
    {
        $reflection = new ReflectionClass($event);

        $models = array();

        if ($reflection->implementsInterface(NotifiableEvent::class)) {
            foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                $value = null;
                if (is_object($event)) {
                    $value = $property->getValue($event);
                } else {
                    $class = $property->getType()->__toString();
                    if (class_exists($class)) {
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
