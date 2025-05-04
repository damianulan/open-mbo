<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use Illuminate\Support\Facades\Schema;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            // load settings from database and overwrite existing
            config([

                // GENERAL
                'app.name' => app(GeneralSettings::class)->site_name ?? env('APP_NAME', 'OpenMBO'),
                'app.debug' => app(GeneralSettings::class)->debug ?? env('APP_DEBUG', true),
                'debugbar.enabled' => app(GeneralSettings::class)->debugbar ?? env('DEBUGBAR_ENABLED', true),
                'app.timezone' => app(GeneralSettings::class)->timezone ?? env('APP_TIMEZONE', 'UTC'),
                'app.locale' => app(GeneralSettings::class)->locale ?? env('APP_LOCALE', 'en'),
                'app.maintenance' => app(GeneralSettings::class)->maintenance ?? null,
                'app.build' => app(GeneralSettings::class)->build ?? null,
                'app.release' => app(GeneralSettings::class)->release ?? null,
                'app.date_format' => app(GeneralSettings::class)->date_format ?? null,
                'app.time_format' => app(GeneralSettings::class)->time_format ?? null,
                'app.datetime_format' => app(GeneralSettings::class)->date_format && app(GeneralSettings::class)->time_format ? app(GeneralSettings::class)->date_format . ' ' . app(GeneralSettings::class)->time_format : null,

                // SERVER
                'mail.default' => app(MailSettings::class)->mail_mailer ?? null,
                'mail.mailers.smtp.host' => app(MailSettings::class)->mail_host ?? null,
                'mail.mailers.smtp.port' => app(MailSettings::class)->mail_port ?? null,
                'mail.mailers.smtp.encryption' => app(MailSettings::class)->mail_encryption ?? null,
                'mail.mailers.smtp.username' => app(MailSettings::class)->mail_username ?? null,
                'mail.mailers.smtp.password' => app(MailSettings::class)->mail_password ?? null,
                'mail.from.address' => app(MailSettings::class)->mail_from_address ?? null,
                'mail.from.name' => app(MailSettings::class)->mail_from_name ?? null,
                'mailcatchall.enabled' => app(MailSettings::class)->mail_catchall_enabled ?? null,
                'mailcatchall.receiver' => app(MailSettings::class)->mail_catchall_receiver ?? null,
            ]);
        }
    }
}
