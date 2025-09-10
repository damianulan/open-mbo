<?php

namespace App\Commentable\Casts;

use App\Events\Core\User\UserMentioned;
use App\Models\Core\User;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class InteractiveText implements CastsAttributes
{
    private const MODE_GET = 'get';

    private const MODE_SET = 'set';

    private const MODE_NORMAL = 'normal';

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return self::getInteractive($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return self::setInteractive($value, $model);
    }

    private static function getUserRoute($id): ?string
    {
        $routeName = 'users.show';
        if (Route::has($routeName)) {
            return route($routeName, $id);
        }

        return null;
    }

    private static function generateTag(string $name, $param): string
    {
        return "<interactive-$name:$param>";
    }

    private static function tagPattern(string $name): string
    {
        return '/<interactive-'.$name.':([0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12})>/i';
    }

    private static function interactiveMentions(string $value, $mode, ?Model $model = null): string
    {
        $sendEvent = false;
        $pattern = '/@([\p{L}\p{M}]+)\s+([\p{L}\p{M}]+)/u';

        if ($mode === self::MODE_SET || $mode === self::MODE_NORMAL) {
            if (preg_match_all($pattern, $value, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $replaceTo = null;
                    $search = null;
                    if ($match[1] && $match[2]) {
                        $firstname = $match[1];
                        $lastname = $match[2];
                        $user = User::whereFirstname($firstname)->whereLastname($lastname)->first();
                        if ($user) {
                            $search = Str::lower("@$firstname $lastname");
                            if ($mode === self::MODE_SET) {
                                $replaceTo = self::generateTag('mention', $user->id);
                                $sendEvent = true;
                            } elseif ($mode === self::MODE_NORMAL) {
                                $route = self::getUserRoute($user->id);
                                if ($route) {
                                    $replaceTo = '<a class="user-mention" href="'.$route.'">'.$user->firstname().' '.$user->lastname().'</a>';
                                }
                            }
                        }
                    }
                    if ($replaceTo && $search) {
                        if ($model) {
                            if ($mode === self::MODE_SET) {
                            }
                        }
                        $value = Str::replace($search, $replaceTo, $value, false);
                    }
                }
            }
        }
        if ($mode === self::MODE_GET) {
            $pattern = self::tagPattern('mention');

            if (preg_match_all($pattern, $value, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {

                    $search = $match[0] ?? null;
                    $id = $match[1] ?? null;
                    if ($id && $search) {
                        $user = User::find($id);
                        $replaceTo = '';
                        if ($user) {
                            $route = self::getUserRoute($user->id);
                            if ($route) {
                                $replaceTo = '<a class="user-mention" href="'.$route.'">'.$user->firstname().' '.$user->lastname().'</a>';
                            }
                        }
                        $value = Str::replace($search, $replaceTo, $value, false);
                    }
                }
            }
        }

        if ($sendEvent && Auth::check()) {
            UserMentioned::dispatch($user, $model, Auth::user());
        }

        return $value;
    }

    public static function interactiveOutput(?string $value): ?string
    {
        if (! empty($value)) {
            $value = self::interactiveMentions($value, self::MODE_NORMAL);
        }

        return $value;
    }

    public static function getInteractive(?string $value): ?string
    {
        if (! empty($value)) {
            $value = self::interactiveMentions($value, self::MODE_GET);
        }

        return $value;
    }

    public static function setInteractive(?string $value, Model $model): ?string
    {
        if (! empty($value)) {
            $value = self::interactiveMentions($value, self::MODE_SET, $model);
        }

        return $value;
    }
}
