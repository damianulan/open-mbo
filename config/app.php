<?php

use App\Casts\CheckboxCast;
use App\Enums\Core\MessageType;
use App\Exceptions\AppException;
use App\Lib\Theme;
use App\Models\Core\User;
use App\Providers\AppServiceProvider;
use App\Providers\ComponentServiceProvider;
use App\Providers\ConfigServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\GateServiceProvider;
use App\Providers\RolesServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Support\Http\ResponseAjax;
use App\Support\Page\PageBuilder;
use Barryvdh\Debugbar\ServiceProvider;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;
use Illuminate\Foundation\Providers\FoundationServiceProvider;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pipeline\PipelineServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Lab404\Impersonate\ImpersonateServiceProvider;
use Lucent\Console\Git;
use Mews\Purifier\Facades\Purifier;
use Mews\Purifier\PurifierServiceProvider;
use Yajra\DataTables\ButtonsServiceProvider;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\ExportServiceProvider;
use Yajra\DataTables\HtmlServiceProvider;

return array(

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'maintenance' => (bool) env('APP_MAINTENANCE', false),

    'auto_update' => (bool) env('APP_AUTO_UPDATE', false),

    'chunk_default' => env('CHUNK_DEFAULT', 250),

    'fallback_locale' => 'pl',

    'available_locales' => array(
        'pl',
        'en',
    ),

    'date_format' => env('DATEFORMAT', 'Y-m-d'),
    'time_format' => env('TIMEFORMAT', 'H:i'),
    'datetime_format' => env('DATEFORMAT', 'Y-m-d') . ' ' . env('TIMEFORMAT', 'H:i'),

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'pl_PL',

    /*
    |--------------------------------------------------------------------------
    | Sensitive Data Model Encryption
    |--------------------------------------------------------------------------
    |
    | It determines whether the sensitive data model encryption is enabled or not.
    | It includes user properties such as firstname, lastname, email, phone, etc. using Enigma Cast Encryption.
    |
    */

    'enigma_models' => env('APP_ENIGMA_MODELS', true),

    /**
     * Application Versioning
     *
     * @key release - increments by one after successful implementation of a milestone.
     * @key build - YYYYMMDDV format.
     * V stands for version build for the specific day (max 9).
     */
    'release' => '0.0.1 beta',
    'build' => 0,

    'head' => Git::head(),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => array(
        'driver' => 'file',
        // 'store'  => 'redis',
    ),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => array(

        /*
         * Laravel Framework Service Providers...
         */
        AuthServiceProvider::class,
        BroadcastServiceProvider::class,
        BusServiceProvider::class,
        CacheServiceProvider::class,
        ConsoleSupportServiceProvider::class,
        CookieServiceProvider::class,
        DatabaseServiceProvider::class,
        EncryptionServiceProvider::class,
        FilesystemServiceProvider::class,
        FoundationServiceProvider::class,
        HashServiceProvider::class,
        MailServiceProvider::class,
        NotificationServiceProvider::class,
        PaginationServiceProvider::class,
        PipelineServiceProvider::class,
        QueueServiceProvider::class,
        RedisServiceProvider::class,
        PasswordResetServiceProvider::class,
        SessionServiceProvider::class,
        TranslationServiceProvider::class,
        ValidationServiceProvider::class,
        ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        DataTablesServiceProvider::class,
        ButtonsServiceProvider::class,
        HtmlServiceProvider::class,
        ExportServiceProvider::class,
        PurifierServiceProvider::class,
        ServiceProvider::class,

        /*
         * Application Service Providers...
         */
        AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        EventServiceProvider::class,
        ComponentServiceProvider::class,
        RouteServiceProvider::class,
        App\Providers\NotificationServiceProvider::class,
        // App\Providers\TelescopeServiceProvider::class,
        RolesServiceProvider::class,
        GateServiceProvider::class,
        ConfigServiceProvider::class,
        ImpersonateServiceProvider::class,
    ),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge(array(
        // 'ExampleClass' => App\Example\ExampleClass::class,
        'PageBuilder' => PageBuilder::class,
        'Theme' => Theme::class,
        'ResponseAjax' => ResponseAjax::class,

        // CASTS
        'CheckboxCast' => CheckboxCast::class,

        // MODELS
        'User' => User::class,

        // VENDORS
        'Purifier' => Purifier::class,

        'AppException' => AppException::class,

        'MessageType' => MessageType::class,
    ))->toArray(),

);
