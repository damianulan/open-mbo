<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Password as PasswordRules;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected const INVALID_OLD_PASSWORD = 'auth.invalid_old_password';

    protected const PASSWORD_REPEATED = 'auth.password_repeated';

    protected string $redirectTo = RouteServiceProvider::HOME;

    public function showForceResetForm(): View
    {
        return view('auth.passwords.password_change', [
            'user' => Auth::user(),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                if ($user->validateNewPassword($password)) {
                    $this->resetPassword($user, $password);
                }

                return self::PASSWORD_REPEATED;
            },
        );

        return $response === Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    public function forceReset(Request $request)
    {
        $response = Password::INVALID_USER;
        $request->validate($this->forceRules(), $this->validationErrorMessages());

        try {
            $user = Auth::user();
            if (Hash::check($request->input('old_password'), $user->password)) {
                $password = $request->input('password');
                if ($user->validateNewPassword($password)) {
                    $this->resetPassword($user, $password);
                    $response = Password::PASSWORD_RESET;
                } else {
                    $response = self::PASSWORD_REPEATED;
                }
            } else {
                $response = self::INVALID_OLD_PASSWORD;
            }
        } catch (Throwable $th) {
            report($th);
        }

        return $response === Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendForceResetFailedResponse($request, $response);
    }

    protected function sendResetFailedResponse(Request $request, string $response)
    {
        $errors = [];

        if ($request->wantsJson()) {
            switch ($response) {
                case self::PASSWORD_REPEATED:
                    $errors['password'] = [trans($response)];
                    break;
                default:
                    $errors['email'] = [trans($response)];
                    break;
            }

            throw ValidationException::withMessages($errors);
        }

        switch ($response) {
            case self::PASSWORD_REPEATED:
                $errors['password'] = trans($response);
                break;
            default:
                $errors['email'] = trans($response);
                break;
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors($errors);
    }

    protected function sendForceResetFailedResponse(Request $request, $response)
    {
        $errors = [];

        if ($request->wantsJson()) {
            switch ($response) {
                case self::INVALID_OLD_PASSWORD:
                    $errors['old_password'] = [trans($response)];
                    break;
                case self::PASSWORD_REPEATED:
                    $errors['password'] = [trans($response)];
                    break;
            }

            throw ValidationException::withMessages($errors);
        }

        switch ($response) {
            case self::INVALID_OLD_PASSWORD:
                $errors['old_password'] = trans($response);
                break;
            case self::PASSWORD_REPEATED:
                $errors['password'] = trans($response);
                break;
        }

        return redirect()->back()
            ->withErrors($errors);
    }

    protected function forceRules(): array
    {
        return [
            'password' => ['required', 'confirmed', new PasswordRules()],
        ];
    }

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', new PasswordRules()],
        ];
    }

    protected function resetPassword(User $user, string $password): void
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));
        $user->force_password_change = 0;

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }
}
