<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use App\Settings\MBOSettings;
use App\Settings\UserSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('settings.general', fn () => app(GeneralSettings::class));
        $this->app->singleton('settings.mail', fn () => app(MailSettings::class));
        $this->app->singleton('settings.mbo', fn () => app(MBOSettings::class));
        $this->app->singleton('settings.users', fn () => app(UserSettings::class));
        $this->app->singleton('settings.notifications', fn () => app(NotificationSettings::class));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            // load settings from database and overwrite existing

            $general = app(GeneralSettings::class);
            $mail = app(MailSettings::class);
            config([
                // GENERAL
                'app.name' => $general->site_name ?? env('APP_NAME', 'OpenMBO'),
                'app.debug' => $general->debug ?? env('APP_DEBUG', true),
                'debugbar.enabled' => ($general->debugbar ?? env('DEBUGBAR_ENABLED', true)) && Auth::check(),
                'app.timezone' => $general->timezone ?? env('APP_TIMEZONE', 'UTC'),
                'app.locale' => $general->locale ?? env('APP_LOCALE', 'en'),
                'app.maintenance' => $general->maintenance ?? null,
                'app.build' => $general->build ?? null,
                'app.release' => $general->release ?? null,
                'app.date_format' => $general->date_format ?? null,
                'app.time_format' => $general->time_format ?? null,
                'app.datetime_format' => $general->date_format && $general->time_format ? $general->date_format . ' ' . $general->time_format : null,

                // SERVER
                'mail.default' => $mail->mail_mailer ?? null,
                'mail.mailers.smtp.host' => $mail->mail_host ?? null,
                'mail.mailers.smtp.port' => $mail->mail_port ?? null,
                'mail.mailers.smtp.encryption' => $mail->mail_encryption ?? null,
                'mail.mailers.smtp.username' => $mail->mail_username ?? null,
                'mail.mailers.smtp.password' => $mail->mail_password ?? null,
                'mail.from.address' => $mail->mail_from_address ?? null,
                'mail.from.name' => $mail->mail_from_name ?? null,
                'mailcatchall.enabled' => $mail->mail_catchall_enabled ?? null,
                'mailcatchall.receiver' => $mail->mail_catchall_receiver ?? null,
            ]);
        }
    }
}
