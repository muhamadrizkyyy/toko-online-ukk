<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        "email" => "required|email",
        "password" => "required"
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            "email" => $this->email,
            "password" => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == "admin" || Auth::user()->role == "seller") {
                return redirect()->route("dashboard.admin");
            } else {
                return redirect()->intended("home");
            }
        } else {
            session()->flash("error", "email & password incorrect");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function render()
    {
        return view('livewire.auth.login')->layout("layouts.auth");
    }
}
