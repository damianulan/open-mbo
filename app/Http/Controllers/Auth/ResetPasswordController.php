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

class ResetPasswordController extends Controller
{
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

    public function forceReset(Request $request)
    {
        $response = null;

        try {
            $request->validate($this->forceRules(), $this->validationErrorMessages());
            $user = Auth::user();
            $password = $request->get('password');
            $this->resetPassword($user, $password);
            $response = Password::PASSWORD_RESET;
        } catch (\Throwable $th) {
            report($th);
        }

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
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
