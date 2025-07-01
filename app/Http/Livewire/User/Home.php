<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    public function getCategory() {
        return Category::all();
    }

    public function getProduct($slug = null) {
        return Product::all();
    }

    public function addToCart($id = null) {
        if (!Auth::check()) {
            return redirect()->route("login")->with("error", "You are not logged in yet");
        }

        try {
            $cart = Cart::where("product_id", $id)->where("user_id", Auth::user()->id)->first();
            $price_product = Product::find($id)->price;

            if ($cart) {
                $cart->qty = $cart->qty + 1;
                $cart->subtotal = $cart->qty * $price_product;
                $cart->save();
            } else {
                Cart::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $id,
                    "qty" => 1,
                    "subtotal" => $price_product
                ]);
            }

            session()->flash("success", "Product was successfully added!");
        } catch (\Throwable $th) {
            session()->flash("error", "Something went wrong!");
            Log::info("add to cart failed " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.home')->layout('layouts.user');
    }
}
