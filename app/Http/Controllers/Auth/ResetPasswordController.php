<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Support\Facades\Password;

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
            $user = $this->getUser();
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
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ];
    }


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
