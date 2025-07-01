<?php

namespace App\Http\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $listeners = [
        "deleteData"
    ];

    public function getTransaction() {
        return PaymentMethod::all();
    }

    public function deleteData($id) {
        try {
            PaymentMethod::find($id)->delete();
            session()->flash("success", "Data was successfully deleted!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("user crud failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.table')->layout('layouts.admin');
    }
}
