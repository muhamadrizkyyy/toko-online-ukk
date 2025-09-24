<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Stringable;
use Livewire\Component;
use Nette\Utils\Random;

class ResetPassword extends Component
{
    public $email, $password, $password_confirmation, $token;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout("layouts.auth");
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $status = Password::reset(
                [
                    "email" => $this->email,
                    "password" => $this->password,
                    "password_confirmation" => $this->password_confirmation,
                    "token" => $this->token,
                ],
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ]);

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        }
    }
}
