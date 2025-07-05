<?php

use App\Exceptions\Core\UnauthorizedAccess;
use Illuminate\Support\Facades\Auth;

function lorem()
{
    return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
}

function lorem_title()
{
    return 'Lorem ipsum dolor sit amet';
}

function lorem_paragraph()
{
    return 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum[d] exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? [D]Quis autem vel eum i[r]ure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?';
}

/**
 *  Returns currently logged user instance or empty instance of User model.
 *  Do not call in class constructors.
 */
function user(?string $user_id = null): App\Models\Core\User
{
    $user = new App\Models\Core\User;
    if (is_null($user_id)) {
        if (Auth::check()) {
            $user = Auth::user();
        }
    } else {
        $user = App\Models\Core\User::find($user_id);
    }

    return $user;
}

/**
 * Checks if currently logged user is a Root user
 */
function isRoot(bool $strict = false): bool
{
    return Auth::user()->isRoot($strict);
}

function ajax(): App\Support\Http\ResponseAjax
{
    return new App\Support\Http\ResponseAjax;
}

function current_theme(): string
{
    $theme = app(App\Settings\GeneralSettings::class)->theme;
    $user = Auth::user();
    if ($user) {
        $userTheme = $user->preferences->theme;
        if ($userTheme && $userTheme !== $theme && $userTheme !== 'auto') {
            $theme = $userTheme;
        }
    }
    $available = App\Lib\Theme::getAvailable();

    if ($available->contains($theme) === false) {
        $theme = $available->first();
    }

    return $theme;
}

function development(): bool
{
    return config('app.env') === 'development';
}

function production(): bool
{
    return config('app.env') === 'production';
}

/**
 * Converts float values to their string representation based on current locale.
 */
function float_view(float $value, int $decimals = 2): string
{
    $lang = app()->getLocale();
    $comma_locale = ['pl'];

    if (in_array($lang, $comma_locale)) {
        return number_format($value, $decimals, ',', ' ');
    }

    return number_format($value, $decimals, '.', ',');
}

function unauthorized($message = '', $permission = null)
{
    throw new UnauthorizedAccess($message, $permission);
}

/**
 * Returns settings value from Spatie Laravel Settings. Requires custom singletons in config service provider.
 *
 * @param  string  $key  - use as group.setting
 * @param  mixed  $default
 * @return void
 */
function setting(string $key, $default = null)
{
    $keys = explode('.', $key);
    $group = $keys[0];
    $key = $keys[1];
    $setting = null;

    if ($group && $key) {
        $appkey = 'settings.'.strtolower($group);
        $class = app($appkey) ?? null;
        $setting = $class ? $class->$key : null;
    }

    if (is_null($setting)) {
        $setting = $default;
    }

    return $setting;
}
