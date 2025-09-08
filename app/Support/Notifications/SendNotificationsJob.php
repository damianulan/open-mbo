<?php

namespace App\Support\Notifications;

use App\Support\Notifications\Contracts\QueueOnCondition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class SendNotificationsJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }

    public function getNotificationClasses(): Collection
    {
        $classes = Cache::get('periodic.notifications', new Collection);

        if (! Cache::has('periodic.notifications')) {

            // Scan the base_path for PHP files
            $finder = new Finder;
            $finder->files()->in(base_path())->name('*.php');

            foreach ($finder as $file) {
                $path = $file->getRealPath();
                $contents = file_get_contents($path);

                // Try to extract namespace + class name
                if (
                    preg_match('/namespace\s+(.+?);/', $contents, $namespaceMatch) &&
                    preg_match('/class\s+(\w+)/', $contents, $classMatch)
                ) {

                    $namespace = $namespaceMatch[1];
                    $className = $classMatch[1];
                    $fqcn = $namespace.'\\'.$className;

                    // Skip if class cannot be autoloaded
                    if (! class_exists($fqcn)) {
                        continue;
                    }

                    $reflection = new ReflectionClass($fqcn);

                    if ($reflection->isInstantiable() && $reflection->implementsInterface(QueueOnCondition::class)) {
                        $classes->push($fqcn);
                    }
                }
            }

            Cache::put('periodic.notifications', $classes);
        }

        return $classes;
    }
}
