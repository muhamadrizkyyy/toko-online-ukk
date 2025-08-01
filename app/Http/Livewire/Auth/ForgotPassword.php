<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout("layouts.auth");
    }

    public function sendResetLinkEmail()
    {
        $this->validate(['email' => 'required|email']);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $status = Password::sendResetLink(
                ["email" => $this->email]
            );

            return $status == Password::RESET_LINK_SENT
                ? redirect()->route("forgot.index")->with('success', __($status))
                : redirect()->route("forgot.index")->withInput($this->only('email'))->withErrors(['email' => __($status)]);
        } else {
            return redirect()->route("forgot.index")->with('error', __('Email not found'));
        }
    }
}
