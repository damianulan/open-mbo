<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\Password as PasswordRules;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    const INVALID_OLD_PASSWORD = 'auth.invalid_old_password';

    const PASSWORD_REPEATED = 'auth.password_repeated';

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function showForceResetForm(Request $request)
    {
        return view('auth.passwords.password_change')->with(
            ['user' => Auth::user()]
        );
    }

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                if($user->validateNewPassword($password)){
                    $this->resetPassword($user, $password);
                }
                return self::PASSWORD_REPEATED;
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function sendResetFailedResponse(Request $request, $response)
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

    public function forceReset(Request $request)
    {
        $response = Password::INVALID_USER;
        $request->validate($this->forceRules(), $this->validationErrorMessages());

        try {
            $user = Auth::user();
            if(Hash::check($request->get('old_password'), $user->password)) {
                $password = $request->get('password');
                if($user->validateNewPassword($password)){
                    $this->resetPassword($user, $password);
                    $response = Password::PASSWORD_RESET;
                } else {
                    $response = self::PASSWORD_REPEATED;
                }
            } else {
                $response = self::INVALID_OLD_PASSWORD;
            }
        } catch (\Throwable $th) {
            report($th);
        }

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendForceResetFailedResponse($request, $response);
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

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function forceRules()
    {
        return [
            'password' => ['required', 'confirmed', new PasswordRules],
        ];
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', new PasswordRules],
        ];
    }

    protected function resetPassword(User $user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));
        $user->force_password_change = 0;

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
