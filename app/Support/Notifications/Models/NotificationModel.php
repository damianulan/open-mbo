<?php

namespace App\Support\Notifications\Models;

use App\Support\Notifications\Factories\ResourceFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Lucent\Support\Traits\UUID;

/**
 * @property-read Collection $resources
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\NotificationModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\NotificationModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\NotificationModel query()
 *
 * @mixin \Eloquent
 */
class NotificationModel extends Model
{
    use UUID;

    protected function fillContent(string $content): string
    {
        return $content;
    }

    protected function resources(): Attribute
    {
        return Attribute::make(
            get: function ($resources): Collection {
                $collection = new Collection();
                foreach (json_decode($resources, true) as $key => $id) {
                    if (class_exists($key)) {
                        if ($model = $key::withTrashed()->find($id)) {
                            if ($resource = ResourceFactory::matchModel($model)) {
                                $collection->push($resource);
                            }
                        }
                    }
                }

                return $collection;
            },
        );
    }
}
