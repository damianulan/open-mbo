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
    public function register(): void
    {
        $this->hideSensitiveRequestDetails();

        Telescope::filter(function (IncomingEntry $entry) {
            $method = 'entry' . ucfirst(config('app.env'));

            return $this->{$method}($entry);
        });
    }

    protected function entryLocal(IncomingEntry $entry): bool
    {
        return (! ($entry->isEvent() && ! $this->filterEvents($entry))) || ($entry->type === EntryType::JOB && $entry->isFailedJob());
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
            $entry->isFailedJob();
    }

    protected function entryProduction(IncomingEntry $entry): bool
    {
        return $entry->isReportableException() ||
            $entry->isFailedRequest() ||
            $entry->isFailedJob() ||
            $entry->isScheduledTask() ||
            $entry->hasMonitoredTag();
    }

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

    protected function gate(): void
    {
        Gate::define('viewTelescope', fn ($user) => $user->can('telescope-view'));
    }

    private function filterEvents(IncomingEntry $entry): bool
    {
        return ! in_array($entry->content['name'], [
            SettingsLoaded::class,
            LoadingSettings::class,
        ]);
    }
}
