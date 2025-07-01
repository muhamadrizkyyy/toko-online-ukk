<?php

namespace App\Http\Livewire\Auth;

use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name, $username, $email, $password, $confirm_pass, $province_id, $regency_id,$address, $phone;

    public function register() {
        $validate = $this->validate([
            "name" => "required",
            "username" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "confirm_pass" => "required|same:password",
            "province_id" => "required",
            "regency_id" => "required",
            "address" => "required",
            "phone" => "required",
        ]);

        $validate["password"] = Hash::make($this->password);
        $validate["role"] = "buyer";

        User::create($validate);

        return redirect()->route("login")->with("success", "User was successfully registered!");
    }

    public function getProvince() {
        return Province::all();
    }

    public function getRegencyByProvince() {
        return Regency::where("province_id", $this->province_id)->get();
    }

    public function render()
    {
        return view('livewire.auth.register')->layout("layouts.auth");;
    }
}
