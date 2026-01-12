<?php

namespace App\Listeners\Vendors;

use App\Settings\Abstract\BaseSettings;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\LaravelSettings\Events\SavingSettings;

class SettingsUpdated implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public $timeout = 180;

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SavingSettings $event): void
    {
        $settings = $event->settings;
        $properties = $event->properties;
        $originalValues = $event->originalValues;
        if ($settings && $properties && $originalValues && $settings instanceof BaseSettings) {
            $original = $originalValues->toArray();
            $dirty = array_filter($properties->toArray(), function($value, $key) use ($original) {
                $old = $original[$key] ?? null;
                if ($old === null) {
                    return false;
                }
                return $old !== $value;
            }, ARRAY_FILTER_USE_BOTH);

            if(!empty($dirty)) {
                $this->processChanges($dirty, $original);
            }
        }
    }

    protected function processChanges(array $dirty, array $original)
    {

    }
}
