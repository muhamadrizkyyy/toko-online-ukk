<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $listeners = [
        "deleteData"
    ];

    public function getProduct() {
        return Product::paginate(10);
    }

    public function deleteData($id) {
        try {
            Product::find($id)->delete();
            session()->flash("success", "Data was successfully deleted!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("product crud failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.product.table')->layout('layouts.admin');
    }
}
