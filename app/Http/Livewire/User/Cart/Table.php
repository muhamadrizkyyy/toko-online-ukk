<?php

namespace App\Http\Livewire\User\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    public $qty, $pickCart = [];

    public function getCart() {
        return Cart::where("user_id", Auth::user()->id)->get();
    }

    public function checkout() {
        session()->put("pickCart" , $this->pickCart);
        return redirect()->route("cart.checkout");
    }

    public function delete($id = null) {
        try {
            Cart::find($id)->delete();
            session()->flash("success", "Data was successfully deleted!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("cart delete failed" . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.cart.table')->layout('layouts.user');
    }
}
