<?php

use App\Casts\CheckboxCast;
use App\Enums\Core\MessageType;
use App\Exceptions\AppException;
use App\Helpers\StorageHelper;
use App\Models\Core\User;
use App\Providers\AppServiceProvider;
use App\Providers\ComponentServiceProvider;
use App\Providers\ConfigServiceProvider;
use App\Providers\EnigmaServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\GateServiceProvider;
use App\Providers\MacroServiceProvider;
use App\Providers\RepositoryServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Support\Filters\Providers\FiltersServiceProvider;
use App\Support\Http\ResponseAjax;
use App\Support\Search\SearchServiceProvider;
use App\Support\UI\Page\PageBuilder;
use App\Support\UI\Theme\Theme;
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
use Mews\Purifier\Facades\Purifier;
use Mews\Purifier\PurifierServiceProvider;
use Yajra\DataTables\ButtonsServiceProvider;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\ExportServiceProvider;
use Yajra\DataTables\HtmlServiceProvider;

return [
    'name' => env('APP_NAME', 'Laravel'),

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', true),

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    'locale' => env('APP_LOCALE', 'en'),

    'maintenance' => (bool) env('APP_MAINTENANCE', false),

    'auto_update' => (bool) env('APP_AUTO_UPDATE', false),

    'chunk_default' => env('CHUNK_DEFAULT', 250),

    'always_throw' => (bool) env('APP_ALWAYS_THROW', env('APP_DEBUG', true)),

    'fallback_locale' => 'pl',

    'available_locales' => [
        'pl',
        'en',
        'it',
    ],

    'date_format' => env('DATEFORMAT', 'Y-m-d'),
    'time_format' => env('TIMEFORMAT', 'H:i'),
    'datetime_format' => env('DATEFORMAT', 'Y-m-d') . ' ' . env('TIMEFORMAT', 'H:i'),

    'faker_locale' => 'pl_PL',

    'enigma_models' => env('APP_ENIGMA_MODELS', true),

    /**
     * @key release - increments by one after successful implementation of a milestone.
     * @key build - YYYYMMDDV format.
     */
    'release' => '0.0.1 beta',
    'build' => 0,

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
    ],

    'providers' => [
        ConfigServiceProvider::class,
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

        DataTablesServiceProvider::class,
        ButtonsServiceProvider::class,
        HtmlServiceProvider::class,
        ExportServiceProvider::class,
        PurifierServiceProvider::class,
        ServiceProvider::class,

        AppServiceProvider::class,
        MacroServiceProvider::class,
        EnigmaServiceProvider::class,
        \App\Providers\AuthServiceProvider::class,
        EventServiceProvider::class,
        ComponentServiceProvider::class,
        RouteServiceProvider::class,
        \App\Providers\NotificationServiceProvider::class,
        GateServiceProvider::class,
        ImpersonateServiceProvider::class,
        SearchServiceProvider::class,
        FiltersServiceProvider::class,
        RepositoryServiceProvider::class,
    ],

    'aliases' => Facade::defaultAliases()->merge([
        'PageBuilder' => PageBuilder::class,
        'Theme' => Theme::class,
        'ResponseAjax' => ResponseAjax::class,

        'CheckboxCast' => CheckboxCast::class,

        'User' => User::class,

        'Purifier' => Purifier::class,

        'AppException' => AppException::class,

        'MessageType' => MessageType::class,
        'StorageHelper' => StorageHelper::class,
    ])->toArray(),
];
