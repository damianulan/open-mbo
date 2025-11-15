<?php

namespace App\Providers;

use App\Support\Notifications\Jobs\NotifyOnEvent;
use App\Support\Notifications\Models\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $classes = $this->getNotifiableEventClasses();
        $events = [];
        if (Schema::hasTable('notifications')) {
            $events = Notification::events()->get()->pluck('event')->toArray();
        }
        $classes = array_filter($classes, function ($class) use ($events) {
            return in_array($class, $events);
        });

        foreach ($classes as $class) {
            Event::listen($class, NotifyOnEvent::class);
        }
    }

    public static function getNotifiableEventClasses(): array
    {
        $classes = [];
        if (Cache::has('notifiable_event_classes')) {
            $classes = Cache::get('notifiable_event_classes');
        } else {
            $namespace = 'App\\';
            $interface = \App\Support\Notifications\Contracts\NotifiableEvent::class;

            $directory = app_path(); // You can narrow this down, e.g. app_path('Events')

            $classes = collect(File::allFiles($directory))
                ->filter(fn($file) => $file->getExtension() === 'php')
                ->map(function ($file) use ($namespace) {
                    $path = $file->getRealPath();
                    $relativePath = str_replace([app_path() . DIRECTORY_SEPARATOR, '.php'], '', $path);
                    $class = $namespace . str_replace(DIRECTORY_SEPARATOR, '\\', $relativePath);

                    return $class;
                })
                ->filter(function ($class) use ($interface) {
                    if (! class_exists($class)) {
                        return false;
                    }

                    $reflection = new ReflectionClass($class);

                    return $reflection->isInstantiable()
                        && $reflection->implementsInterface($interface);
                })
                ->values()
                ->toArray();

            Cache::put('notifiable_event_classes', $classes, now()->addDays(7));
        }

        return $classes;
    }
}
