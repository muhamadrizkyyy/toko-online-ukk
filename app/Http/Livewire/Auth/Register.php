<?php

namespace App\Http\Livewire\Auth;

use App\Models\Buyer;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Register extends Component
{
    public $name, $username, $email, $password, $confirm_pass;
    public $province_id, $regency_id, $district_id, $village_id, $address, $phone;

    public function register()
    {
        $validate = $this->validate([
            "name" => "required",
            "username" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "confirm_pass" => "required|same:password",
            "province_id" => "required",
            "regency_id" => "required",
            "district_id" => "required",
            "village_id" => "required",
            "address" => "required",
            "phone" => "required",
        ]);

        try {
            $user = User::create([
                "name" => $this->name,
                "username" => $this->username,
                "email" => $this->email,
                "password" => Hash::make($this->password),
                "role" => "buyer",
            ]);

            $buyer = Buyer::create([
                "user_id" => $user->id,
                "province_id" => $this->province_id,
                "regency_id" => $this->regency_id,
                "district_id" => $this->district_id,
                "village_id" => $this->village_id,
                "address" => $this->address,
                "phone" => $this->phone,
            ]);

            event(new Registered($user));

            return redirect()->route("verification.notice")->with("success", "User was successfully registered!");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong!");
            Log::error("registered failed: " . $th->getMessage());
        }
    }

    public function getProvince()
    {
        return Province::all();
    }

    public function getRegencyByProvince()
    {
        return Regency::where("province_id", $this->province_id)->get();
    }

    public function getDistrictByRegency()
    {
        return District::where("regency_id", $this->regency_id)->get();
    }

    public function getVillageByDistrict()
    {
        return Village::where("district_id", $this->district_id)->get();
    }

    public function render()
    {
        return view('livewire.auth.register')->layout("layouts.auth");;
    }
}
