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
        if(Schema::hasTable('settings')){
            // load settings from database and overwrite existing
            config([

                // GENERAL
                'app.name' => app(GeneralSettings::class)->site_name,
                'app.debug' => app(GeneralSettings::class)->debug,
                'app.timezone' => app(GeneralSettings::class)->timezone,
                'app.locale' => app(GeneralSettings::class)->locale,
                'app.build' => app(GeneralSettings::class)->build,
                'app.release' => app(GeneralSettings::class)->release,
                'app.date_format' => app(GeneralSettings::class)->date_format,
                'app.time_format' => app(GeneralSettings::class)->time_format,
                'app.datetime_format' => app(GeneralSettings::class)->date_format . ' ' .app(GeneralSettings::class)->time_format,

                // SERVER
                'mail.default' => app(MailSettings::class)->mail_mailer,
                'mail.mailers.smtp.host' => app(MailSettings::class)->mail_host,
                'mail.mailers.smtp.port' => app(MailSettings::class)->mail_port,
                'mail.mailers.smtp.encryption' => app(MailSettings::class)->mail_encryption,
                'mail.mailers.smtp.username' => app(MailSettings::class)->mail_username,
                'mail.mailers.smtp.password' => app(MailSettings::class)->mail_password,
                'mail.from.address' => app(MailSettings::class)->mail_from_address,
                'mail.from.name' => app(MailSettings::class)->mail_from_name,

            ]);
        }
    }
}
