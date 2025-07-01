<?php

namespace App\Http\Livewire\User\Component;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartBtn extends Component
{
    public function countCart() {
        return Cart::where("user_id", Auth::id())->count();
    }

    public function render()
    {
        return view('livewire.user.component.cart-btn');
    }
}
