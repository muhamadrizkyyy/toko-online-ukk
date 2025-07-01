<?php

namespace App\Http\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Form extends Component
{
    public $payment_method_id;
    public $name,$no_rek;

    public function mount($id = null) {
        if ($id) {
            $c = PaymentMethod::find($id);
            $this->payment_method_id = $id;
            $this->name = $c->name;
            $this->no_rek = $c->no_rek;
        }
    }

    public function saveData() {
        $validate = $this->validate([
            "name" => "required",
            "no_rek" => "nullable",
        ]);

        try {
            if($this->payment_method_id) {
                PaymentMethod::find($this->payment_method_id)->update([
                    "name" => $this->name,
                    "no_rek" => $this->no_rek,
                ]);
            } else {
                PaymentMethod::create([
                    "name" => $this->name,
                    "no_rek" => $this->no_rek,
                ]);
            }

            return redirect()->route("payment_method")->with("success", "Data was successfully saved!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("category crud failed" . $th->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.admin.payment-methods.form')->layout('layouts.admin');
    }
}
