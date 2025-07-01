<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Form extends Component
{
    public $user_id;
    public $province_id, $regency_id, $name, $username, $email, $password, $confirm_pass, $address, $phone, $role_u;

    public function mount($id = null) {
        if ($id) {
            $user = User::find($id);
            $this->user_id = $id;
            $this->name = $user->name;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->province_id = $user->province_id;
            $this->regency_id = $user->regency_id;
            $this->address = $user->address;
            $this->phone = $user->phone;
            $this->role_u = $user->role;
        }
    }

    public function saveData() {
        if ($this->user_id) {
            $this->validate([
                "name" => "required",
                "username" => "required",
                "email" => "required|unique:users,email,". $this->user_id,
                "password" => "nullable",
                "confirm_pass" => "nullable|same:password",
                "province_id" => "required",
                "regency_id" => "required",
                "address" => "required",
                "phone" => "required",
                "role_u" => "required",
            ]);
        } else {
            $validate = $this->validate([
                "name" => "required",
                "username" => "required",
                "email" => "required|unique:users,email",
                "password" => "required",
                "confirm_pass" => "required|same:password",
                "province_id" => "required",
                "regency_id" => "required",
                "address" => "required",
                "phone" => "required",
                "role_u" => "required",
            ]);
            unset($validate["role_u"]);
            $validate["password"] = Hash::make($this->password);
            $validate["role"] = $this->role_u;
        }

        try {
            if($this->user_id) {
                $user = User::find($this->user_id);
                $user->name = $this->name;
                $user->username = $this->username;
                $user->email = $this->email;
                $user->province_id = $this->province_id;
                $user->regency_id = $this->regency_id;
                $user->address = $this->address;
                $user->phone = $this->phone;
                $user->role = $this->role_u;
                if($this->password) {
                    $user->password = Hash::make($this->password);
                }
                $user->save();
            } else {
                User::create($validate);
            }

            return redirect()->route("users")->with("success", "Data was successfully saved");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("user crud failed" . $th->getMessage());
        }

    }

    public function getProvince() {
        return Province::all();
    }

    public function getRegencyByProvince() {
        return Regency::where("province_id", $this->province_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.user.form')->layout('layouts.admin');
    }
}
