<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;
use Spatie\LaravelSettings\Events\LoadingSettings;
use Spatie\LaravelSettings\Events\SettingsLoaded;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        Telescope::filter(function (IncomingEntry $entry) {
            $method = 'entry'.ucfirst(config('app.env'));

            return $this->$method($entry);
        });
    }

    protected function entryLocal(IncomingEntry $entry): bool
    {
        if ($entry->isEvent() && ! $this->filterEvents($entry)) {
            return false;
        }

        return true;
    }

    protected function entryDevelopment(IncomingEntry $entry): bool
    {
        if ($entry->isEvent() && ! $this->filterEvents($entry)) {
            return false;
        }

        return $entry->isScheduledTask() ||
            $entry->isFailedRequest() ||
            $entry->isLog() ||
            $entry->isSlowQuery() ||
            $entry->isException() ||
            $entry->isDump() ||
            $entry->isEvent() ||
            $entry->hasMonitoredTag() ||
            $entry->isGate() ||
            $entry->type === EntryType::JOB;
    }

    protected function entryProduction(IncomingEntry $entry): bool
    {
        return $entry->isReportableException() ||
            $entry->isFailedRequest() ||
            $entry->isFailedJob() ||
            $entry->isScheduledTask() ||
            $entry->hasMonitoredTag();
    }

    private function filterEvents(IncomingEntry $entry): bool
    {
        return ! in_array($entry->content['name'], [
            SettingsLoaded::class,
            LoadingSettings::class,
        ]);
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return $user->can('telescope-view');
        });
    }
}
